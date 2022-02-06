<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        $products = $cart->products()->get();

        return view('checkout.index')->with([
            'cart' => $cart,
            'products' => $products,
            'discountValue' => getNumbers()->get('discountValue'),
            'discountPercent' => getNumbers()->get('discountPercent'),
            'newSubtotal' => getNumbers()->get('newSubtotal'),
            'newTax' => getNumbers()->get('newTax'),
            'newTotal' => getNumbers()->get('newTotal')
        ]);
    }
}
