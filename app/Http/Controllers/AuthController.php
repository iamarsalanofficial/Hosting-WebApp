<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ForgotPasswordMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{ 
    public function login()
    {
        // dd(Hash::make('123456'));
        if (!empty (Auth::check()))
         {
            if(Auth::user()->is_admin == 1)
            {
                return redirect('admin/index');
            }
            elseif (Auth::user()->is_admin == 2) 
            {
                return redirect('user/dashboard');
            }
            
        } 
        else {
        
            return view('auth.login');
        }
    }
    public function AuthLogin(Request $request)
    {
        // dd($request->all());
        $remember = !empty($request->remember) ? true : false;
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember ))
         {
            if(Auth::user()->is_admin == 1)
            {
                return redirect('admin/index');
            }
            elseif (Auth::user()->is_admin == 2) 
            {
                return redirect('user/dashboard');
            }
        }
        else {
            return redirect()->back()->with('error', 'Please Enter correct email & password');
        }
    }

    public function signup(){
        return view('auth.signup');
    }
    public function AuthSignup(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'cpassword' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Create a new user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Redirect to a success page or login page
        return redirect()->back('login')->with('success', 'Registration successful! Please login.');

    }
    public function forgotpassword(){
        return view('auth.forgot');
    }
   

    public function PostForgotPassword(Request $request){
        $user = User::getEmailSingle($request->email);
        if ($user) {
            // Validate the email
            if (!filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
                return redirect()->back()->with('error', "Invalid email address.");
            }
        
            // Generate token and save
            $user->remember_token = Str::random(30);
            $user->save();
        
            // Try to send email
            try {
                Mail::to($user->email)->send(new ForgotPasswordMail($user));
                return redirect()->back()->with('success', "Please Check Your Email And Reset Password.");
            } catch (\Exception $e) {
                return redirect()->back()->with('error', "Error sending email: " . $e->getMessage());
            }
        } else {
            return redirect()->back()->with('error', "Email Not Found.");
        }
        
    }

    public function reset($remember_token)
    {
        $user = User::getTokenSingle($remember_token);
        if(!empty($user))
        {
            $data['user'] = $user;
            return view('auth.reset', $data);
        }
        else{
            abort(404) ;
        }
    }
    public function PostReset($token, Request $request){

        if($request->password == $request->cpassword)
        {
            $user = User::getTokenSingle($token);
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->save();

            return redirect(url(path: ''))->with('success', "Password Successfuly Reset");

        }else{
            return redirect()->back()->with('error', "Password and Confirm Password does not match.");
        }
    }


    public function logout(){
        Auth::logout();
        return redirect(url(''));
    }
}
