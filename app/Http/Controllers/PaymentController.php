<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function checkout() {

        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
    
        $token = $gateway->ClientToken()->generate();
        return view('guests.checkout', compact('token'));
    }

    public function payment(Request $request) {
        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
        
        $totalPrice = $request->totalPrice;
        $nonce = $request->payment_method_nonce;
        $name = $request->name;
        $surname = $request->surname;
        $email = $request->email;
    
        $result = $gateway->transaction()->sale([
            'amount' => $totalPrice,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ],
            'customer' => [
                'firstName' => $name,
                'lastName' => $surname,
                'email' => $email,
            ]

        ]);

    
        if ($result->success) {
            $transaction = $result->transaction;
            return view('success', [ 'message' => 'Payment successfull!']);
        } else {
            $errorString = "";
    
            foreach($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }
    
            return back()->withErrors('message', 'Transaction succsessfull. Id ' . $result->message);
        }
    }
}
