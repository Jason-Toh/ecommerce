<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $orderItems = new Collection;
        $orders = Order::where('user_id', Auth::id())->get();
        // foreach ($orders as $order) {
        //     $products = $order->products()->get();
        //     $orderItems->push(['order' => $order, 'products' => $products]);
        // }
        return view('orders', compact('orders'));
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

        $cart = session()->get('cart');

        $total = 0;
        foreach ($cart as $product) {
            $total += (float) $product['price'] * (float) $product['quantity'];
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'billing_name' => $request->name,
            'billing_email' => $request->email,
            'billing_address' => $request->address,
            'billing_city' => $request->city,
            'billing_postcode' => $request->post_code,
            'billing_country' => $request->country,
            'billing_phone' => $request->phone_number,
            'billing_total' => $total
        ]);

        // Attach the products to the order_product table
        foreach ($cart as $id => $product) {
            $order->products()->attach($id, ['quantity' => $product['quantity']]);
        }

        session()->flash('success', 'Your order has been made successfully');

        session()->forget('cart');
        return redirect('products');
    }
}
