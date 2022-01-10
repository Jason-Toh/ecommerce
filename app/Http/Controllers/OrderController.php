<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        return view('orders');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'string|required',
            'email' => 'string|email|required',
            'address' => 'string|required',
            'city' => 'string|required',
            'post_code' => 'string|required',
            'country' => 'string|required',
            'phone_number' => 'string|required'
        ]);
    }
}
