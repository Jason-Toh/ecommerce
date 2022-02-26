<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->get();
        return view('orders.index', compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'string|required',
            'email' => 'string|email|required',
            'address' => 'string|required',
            'city' => 'string|required',
            'post_code' => 'string|required',
            'country' => 'string|required',
            'phone_number' => 'string|required'
        ]);

        $cart = Cart::where('user_id', Auth::id())->first();

        $order = Order::create([
            'user_id' => Auth::id(),
            'billing_name' => $request->name,
            'billing_email' => $request->email,
            'billing_address' => $request->address,
            'billing_city' => $request->city,
            'billing_postcode' => $request->post_code,
            'billing_country' => $request->country,
            'billing_phone' => $request->phone_number,
            'billing_discount_code' => getNumbers()->get('discountCode'),
            'billing_discount_value' => getNumbers()->get('discountValue'),
            'billing_subtotal' => getNumbers()->get('newSubtotal'),
            'billing_tax_value' => getNumbers()->get('newTax'),
            'billing_total' => getNumbers()->get('newTotal')
        ]);

        $products = $cart->products()->get();

        // Insert the products into the order_product table
        foreach ($products as $product) {
            $order->products()->attach($product->id, [
                'quantity' => $product->pivot->quantity
            ]);
        }

        // Reset all values to 0
        $cart->subtotal = 0;
        $cart->tax_value = 0;
        $cart->total = 0;
        $cart->total_items = 0;
        $cart->save();

        // Empty the cart
        $cart->products()->detach();

        session()->flash('success', 'Your order has been made successfully');

        return redirect()->route('products.index');
    }
}
