<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;

class StripePaymentController extends Controller
{
    public function index()
    {
        return view('payment');
    }

    public function charge(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $charge = Charge::create([
            'amount' => 1000,
            'currency' => 'usd',
            'source' => $request->stripeToken,
            'description' => 'Test Payment',
        ]);

        // You can save the charge info or handle success/failure here
        return "Payment successful!";
    }
}
