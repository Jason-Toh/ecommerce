<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function registration(){
        return view('auth.register');
    }

    public function customLogin(Request $request){
        $request->validate([
            'email' => 'string|email|exists:users,email|required',
            'password' => 'string|required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {

            // flash is used for short lived status message
            session()->flash('success', 'Logged in Successfully!');

            // redirect to the previously intended location
            return redirect()->intended('home');
        }

        session()->flash('error', 'Password is incorrect.');
        return redirect('login');
    }

    public function customRegistration(Request $request){
        $request->validate([
            'name' => 'string|required',
            'email' => 'string|email|unique:users|required',
            'password' => 'string|confirmed|required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        session()->flash('success', 'Registered Successfully!');
        return redirect('login');
    }

    public function logout(){
        // Remove all data from the session
        session()->flush();
        Auth::logout();

        return redirect()->back();
    }
}
