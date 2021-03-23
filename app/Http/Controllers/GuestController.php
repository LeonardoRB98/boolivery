<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;

class GuestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $restaurants = Restaurant::all();

        return view('guests.index', compact('restaurants'));
    }

    public function show($slug)
    {
        $restaurant = Restaurant::where('slug', $slug)->firstOrFail();
        // dd($restaurant);
        return view('guests.show', compact('restaurant'));
    }

    public function checkout() {
        // sandbox variables
        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        // client token
        $token = $gateway->ClientToken()->generate();

        // return view checkout with client token
        return view('guests.checkout', [
            'token' => $token
        ]);
    }

    public function payment(Request $request) {
        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        $name = $request->name;
        $surname = $request->surname;
        $mail = $request->mail;
        $totalPrice = $request->totalPrice;
        $nonce = $request->payment_method_nonce;

        // make a sale
        $result = $gateway->transaction()->sale([
            'amount' => $totalPrice,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ],
            'customer' => [
                'firstName' => $name,
                'lastName' => $surname,
                'email' => $mail,
            ]
        ]);
        dd($result);
        if ($result->success || !is_null($result->transaction)) {
            // $transaction = $result->transaction;
            return redirect('home');
        } else {
            $errorString = "";

            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }
            return back()->withErrors('Pagamento respinto: ' . $result->message);
        }
    }

}
