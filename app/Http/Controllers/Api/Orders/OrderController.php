<?php

namespace App\Http\Controllers\Api\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree\Gateway;
use App\Http\Requests\Orders\OrderRequest;
use App\Models\Sponsor;
use App\Models\Payment;

class OrderController extends Controller
{
    public function generate(Request $request, Gateway $gateway){
        $token = $gateway->clientToken()->generate();
        $data = [
            'success'=>true,
            'token'=> $token
        ];
        return response()->json($data, 200);
    }

    public function makePayment(OrderRequest $request, Gateway $gateway){


        $sponsor= Sponsor::find($request->sponsor);
        $result = $gateway->transaction()->sale([

            'amount'=>$sponsor->price,
            'paymentMethodNonce'=>$request->token,
            'options'=>[
                'submitForSettlement'=>true
            ]
        ]);

        if($result->success){
            $data = [
                'success'=>true,
                'message'=> 'transazione eseguita con successo'
            ];
            return response()->json($data, 200);
        } else{
            $data = [
                'success'=>false,
                'message'=> 'transazione NON eseguita'
            ];
            return response()->json($data, 401);
        };


    }

    public function create(Request $request )
    {
        $gateway = new Gateway([
            'environment'=>'sandbox',
            'merchantId'=>'qbt7zts4952sjd6f',
            'publicKey'=>'bxc6x72jq5wxyyq2',
            'privateKey'=>'ca5c675f4bc5668e2488d26ad36c1e23'
        ]);

        // $nonce = $request->input('payment_method_nonce');
        $result = $gateway->transaction()->sale([
            'amount' => '1000.00',
            'paymentMethodNonce' => 'fake-valid-nonce',
            'options' => ['submitForSettlement' => true],
        ]);
        if ($result->success) {
            // ApartmentSponsor::create([
            //     'amount' => '10.00',
            //     'status' => 'completed',
            //     'transaction_id' => $result->transaction->id,
            // ]);

            return redirect()->route('selectPayment')->with('success',  ' Pagamento riuscito');
        } else {
            return back()->with('error', 'Payment failed. Please try again.');
        }
    }
}
