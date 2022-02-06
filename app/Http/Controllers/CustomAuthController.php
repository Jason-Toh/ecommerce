<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'string|email|exists:users,email|required',
            'password' => 'string|required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {

            // flash is used for short lived status message
            session()->flash('success', 'Logged in Successfully!');

            // redirect to the previously intended location
            return redirect()->intended('dashboard');
        }

        session()->flash('error', 'Password is incorrect.');
        return redirect()->route('login.index');
    }

    public function postRegister(Request $request)
    {
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

        $cart = Cart::create([
            'user_id' => $user->id
        ]);

        return redirect()->route('login.index')->withSuccess('Registered Successfully!');
    }

    public function logout()
    {
        // Remove all data from the session
        session()->flush();
        Auth::logout();

        return redirect()->back();
    }
}
