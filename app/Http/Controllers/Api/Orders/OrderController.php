<?php

namespace App\Http\Controllers\Api\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree\Gateway;
use App\Http\Requests\Orders\OrderRequest;
use App\Models\Sponsor;

class OrderController extends Controller
{
    public function generate(Request $request, Gateway $gateway){
        // dd($gateway->clientToken()->generate());
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
}
