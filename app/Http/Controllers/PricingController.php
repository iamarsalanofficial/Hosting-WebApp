<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PricingController extends Controller
{
     // Show pricing page
     public function showPricing()
     {
         // Pricing plans ka data yahan se bhejenge.
        $plans = [
            ['name' => 'Namo Starter - 3 Years', 'price' => 360],
            ['name' => 'Namo Go - 3 Years', 'price' => 648],
            ['name' => 'Namo Go - 2 Years', 'price' => 456],
        ];

        return view('pricing', ['plans' => $plans]);
     }
 
     
}
