<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CartController;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        // $total = CartController::getCartTotal();
        $total = 0;
        foreach ($cart as $product) {
            $total += (float) $product['price'] * (float) $product['quantity'];
        }
        return view('checkout')->with(['products' => $cart, 'total' => $total]);
    }
}
