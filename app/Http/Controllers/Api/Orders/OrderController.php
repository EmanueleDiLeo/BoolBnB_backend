<?php

namespace App\Http\Controllers\Api\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree\Gateway;
use App\Http\Requests\Orders\OrderRequest;
use App\Models\Sponsor;
use App\Models\Payment;
use App\Models\Apartment;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function generate(Request $request, Gateway $gateway)
    {
        $token = $gateway->clientToken()->generate();
        $data = [
            'success' => true,
            'token' => $token
        ];
        return response()->json($data, 200);
    }

    // public function makePayment(OrderRequest $request, Gateway $gateway){


    //     $sponsor= Sponsor::find($request->sponsor);
    //     $result = $gateway->transaction()->sale([

    //         'amount'=>$sponsor->price,
    //         'paymentMethodNonce'=>$request->token,
    //         'options'=>[
    //             'submitForSettlement'=>true
    //         ]
    //     ]);

    //     if($result->success){
    //         $data = [
    //             'success'=>true,
    //             'message'=> 'transazione eseguita con successo'
    //         ];
    //         return response()->json($data, 200);
    //     } else{
    //         $data = [
    //             'success'=>false,
    //             'message'=> 'transazione NON eseguita'
    //         ];
    //         return response()->json($data, 401);
    //     };


    // }

    public function create(Request $request, Apartment $apartment)
    {
        dd($request);
        $sponsor = Sponsor::find($request->sponsor);
        $apartment = Apartment::find($request->apartment);
        $gateway = new Gateway([
            'environment' => 'sandbox',
            'merchantId' => 'qbt7zts4952sjd6f',
            'publicKey' => 'bxc6x72jq5wxyyq2',
            'privateKey' => 'ca5c675f4bc5668e2488d26ad36c1e23'
        ]);

        // $nonce = $request->input('payment_method_nonce');
        $result = $gateway->transaction()->sale([
            'amount' => $sponsor->price,
            'paymentMethodNonce' => 'fake-valid-nonce',
            'options' => ['submitForSettlement' => true],
        ]);
        if ($result->success) {

            $check_exist = Apartment::join('apartment_sponsor', function ($join) {
                $join->on('apartments.id', '=', 'apartment_sponsor.apartment_id');
            })
                ->where('id', $apartment->id)
                ->max('end_date');

            $now = Carbon::now('GMT+1');
            $new_date = Carbon::createFromFormat('Y-m-d H:i:s', $now, 'Europe/Rome');

            if ($check_exist == null) {
                $end_date = $new_date->addHours($sponsor->duration);
                $apartment->sponsors()->attach($sponsor, [
                    'end_date' => $end_date,
                    'apartment_id' => $apartment->id,
                    'sponsor_id' => $sponsor->id
                ]);


                return redirect()->route('selectPayment', $apartment)->with('success',  ' Pagamento riuscito');
            } elseif ($check_exist > Carbon::now('GMT+1')) {
                $check_exist = Carbon::createFromFormat('Y-m-d H:i:s', $check_exist, 'Europe/Rome');
                $end_date = $check_exist->addHours($sponsor->duration);
                $apartment->sponsors()->attach($sponsor, [
                    'end_date' => $end_date,
                    'apartment_id' => $apartment->id,
                    'sponsor_id' => $sponsor->id
                ]);
                return redirect()->route('selectPayment', $apartment)->with('success',  'Sponsorizzazione aumentata con successo!');
            }
        } else {
            return back()->with('error', 'Pagamento fallito, prova di nuovo.');
        }
    }
}
