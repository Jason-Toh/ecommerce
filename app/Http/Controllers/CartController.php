<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index(){
        $cart = session()->get('cart',[]);
        return view('cart')->with(['products' => $cart]);
    }

    public function add($id){
        // https://stackoverflow.com/questions/33027047/what-is-the-difference-between-find-findorfail-first-firstorfail-get
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        // If the item exists in the shopping cart
        if(isset($cart[$id])){
            // Increase the quantity
            $cart[$id]['quantity']++;
            // Increase the total price of the item in the cart based on quantity
            // $this->items[$id]['price'] *= $this->items[$id]['quantity'];
        } else {
            $cart[$id] = [
                'quantity' => 1,
                'price' => $product->price,
                'item' => $product,
                'image' => $product->image
            ];
        }

        // dd() is Dump and die
        // dd(session()->get('cart'));

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request){
        $id = $request->id;
        $quantity = $request->quantity;

        if($id && $quantity){
            $cart = session()->get('cart');
            $cart[$id]['quantity'] = $quantity;
            session()->put('cart',$cart);
            session()->flash('success', 'Cart Updated Successfully');
        }
    }

    public function remove($id){
        $cart = session()->get('cart');

        if(isset($cart[$id])){
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Product removed from cart successfully!');
    }

    public function getCartTotal(){
        $cart = session()->get('cart');
        $total = 0;
        foreach($cart as $product){
            $total += (float) $product['price'] * (float) $product['quantity'];
        }
        return $total;
    }
}
