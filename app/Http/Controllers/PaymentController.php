<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Braintree\ClientToken;
use Braintree\Transaction;


class PaymentController extends Controller
{
    public function initialize()
    {
        $token = ClientToken::generate();
        return response()->json(['token' => $token]);
    }

    public function process(Request $request)
    {
        $status = Transaction::sale([
            'amount' => $request->amount,
            'paymentMethodNonce' => $request->payment_method_nonce,
            'options' => [
                'submitForSettlement' => True
            ]
        ]);

        if ($status->success) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
