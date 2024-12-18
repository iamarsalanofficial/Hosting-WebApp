<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    public function show(Request $request)
    {
        // Validate plan selection
        $validated = $request->validate([
            'plan_duration' => 'required|string',
            'plan_price' => 'required|numeric',
        ]);

        // Set plan name dynamically
        $plan_duration = $request->input('plan_duration');
        $plan_price = $request->input('plan_price');
        $plan_name = "Namo Go - " . $plan_duration;

        return view('checkout', compact('plan_duration', 'plan_price', 'plan_name'));
    }

    public function showPricing()
    {
        // Pricing plans can be fetched from the database as per requirements.
        $plans = [
            ['name' => 'Namo Starter - 1 Years', 'price' => 20],
            ['name' => 'Namo Go - 2 Years', 'price' => 19],
            ['name' => 'Namo Go - 3 Years', 'price' => 18],
        ];

        return view('pricing', ['plans' => $plans]);
    }

    public function showCheckout(Request $request)
    {
        dd($request->all());
        // Validate incoming data from the checkout form
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'country' => 'required|string',
            'street_address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip' => 'required|string|max:10',
            'phone' => 'required|string|max:15',
            'email' => 'required|email',
            'terms' => 'accepted',
        ]);

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

        // Calculate price per month for each plan
        foreach ($orderSummary as $key => $order) {
            $duration = explode(' ', $order['name'])[2]; // Extract duration, e.g., "1 Year"
            $durationInMonths = $duration == 'Year' ? 12 : ($duration == '2' ? 24 : 36); // Adjust based on the duration
            $orderSummary[$key]['price_per_month'] = number_format($order['price'] / $durationInMonths, 2);
        }

        return view('checkout', compact('orderSummary', 'subtotal', 'fee', 'total'));

    }
}
