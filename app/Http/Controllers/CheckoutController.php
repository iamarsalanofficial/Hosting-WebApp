<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    // Show checkout page
    public function show(Request $request)
    {
        if (!$request->has(['plan_duration', 'plan_price'])) {
            return redirect()->route('pricing.page')->with('error', 'Please select a plan first.');
        }

        $plan_duration = $request->input('plan_duration');
        $plan_price = $request->input('plan_price');
        $plan_name = "Namo Go - " . $plan_duration;

        return view('checkout', compact('plan_duration', 'plan_price', 'plan_name'));
    }





    public function showCheckout()
    {
        // Example data for order summary
        $orderSummary = [
            ['name' => 'Namo Starter - 3 Years', 'quantity' => 1, 'price' => 360.00],
            ['name' => 'Namo Go - 3 Years', 'quantity' => 1, 'price' => 648.00],
            ['name' => 'Namo Go - 2 Years', 'quantity' => 1, 'price' => 456.00],
        ];

        // Calculate subtotal and fee
        $subtotal = array_sum(array_column($orderSummary, 'price'));
        $fee = 65.88;
        $total = $subtotal + $fee;

        return view('checkout', compact('orderSummary', 'subtotal', 'fee', 'total'));
    }

    // Process checkout form
    public function processCheckout(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'country' => 'required',
            'street_address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required|numeric',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'username' => 'required|string|max:255',
            'terms' => 'accepted',
        ]);

        // Payment processing logic here
        // Example: PayPal integration or storing order in database

        return redirect()->route('checkout')->with('success', 'Order placed successfully!');
    }
}
