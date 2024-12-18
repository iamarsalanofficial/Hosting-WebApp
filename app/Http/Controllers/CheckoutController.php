<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{   
    public function show(Request $request)
    {
        if (!$request->has(['plan_duration', 'plan_price'])) {
            return redirect()->route('pricing')->with('error', 'Please select a plan first.');
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
            ['name' => 'Namo Starter - 1 Year', 'quantity' => 1, 'price' => 360.00],
            ['name' => 'Namo Go - 3 Years', 'quantity' => 1, 'price' => 648.00],
            ['name' => 'Namo Go - 2 Years', 'quantity' => 1, 'price' => 456.00],
        ];

        // Calculate subtotal and fee
        $subtotal = array_sum(array_column($orderSummary, 'price'));
        $fee = 65.88;
        $total = $subtotal + $fee;

        return view('checkout', compact('orderSummary', 'subtotal', 'fee', 'total'));
    }
    
}
