<?php

namespace App\Http\Controllers;

use App\Models\Order;
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
            'amount' => $request->total_price,
            'paymentMethodNonce' => $request->payment_method_nonce,
            'options' => [
                'submitForSettlement' => True
            ]
        ]);

        $newOrder = new Order();
        $newOrder->name = $request->name;
        $newOrder->last_name = $request->last_name;
        $newOrder->address = $request->address;
        $newOrder->phone = $request->phone;
        $newOrder->total_price = $request->total_price;
        //Implementare order_dishes

        if ($status->success) {
            $newOrder->status = 1;
            return response()->json(['success' => true]);
        } else {
            $newOrder->status = 0;
            return response()->json(['success' => false]);
        }
    }
}
