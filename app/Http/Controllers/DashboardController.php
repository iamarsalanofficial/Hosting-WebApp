<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function dashboard()
    { 
        if(Auth::user()->is_admin == 1)
        {
            return view('admin.index' );
        }
        elseif (Auth::user()->is_admin == 2) 
        {
            return view('user.dashboard');
        }
        
    }
}
