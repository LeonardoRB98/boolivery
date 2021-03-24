<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Plate;

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

        // QUESTO MANDA I DATI A BRAINTREE
        $data = $request->all();
        // dd($data);
        $total = $request->total;
        $nonce = $request->payment_method_nonce;
        $name = $request->name;
        $surname = $request->surname;
        $email = $request->email;

        // QUESTO ASSOCIA I DATI E LI INVIA
        $result = $gateway->transaction()->sale([
            'amount' => $total,
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

            // QUI DEFINISCO UN NUOVO ORDINE
            $newOrder = new Order();
            $newOrder['status'] = true;
            $newOrder['date'] = date("Y-m-d H:i:s");
            $newOrder->fill($data);
            $newOrder->save();
            // dd($data);


            $i = 0;
            foreach($data["plates"] as $plate) {
                // aggiungo la colonna quantity al piatto dell ordine
                $newOrder->plates()->attach($plate,['quantity' => $data["quantities"][$i]]);
                $i++;
            }



            return view('guests.checkoutconfirm', ['message' => 'Pagamento avvenuto con successo']);

        } else {
            $errorString = "";

            foreach($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }

            $newOrder = new Order();
            $newOrder['status'] = false;
            // $newOrder['plate_id'] = $data[''];
            $newOrder->fill($data);
            // dd($newOrder);
            $newOrder->save();

            return back()->withErrors('message', 'Transaction succsessfull. Id ' . $result->message);
        }
    }
}
