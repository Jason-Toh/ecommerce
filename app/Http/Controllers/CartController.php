<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
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

        return view('cart')->with([
            'cart' => $cart,
            'products' => $products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->product_id;
        $quantity = $request->quantity;

        /*
         * first() returns a model
         * get() returns a collection 
         */

        $cart = Cart::where('user_id', Auth::id())->first();

        // Returns a Product Model
        $product = $cart->products()->where('product_id', $id)->first();

        // If the product exist
        if ($product) {
            // update the quantity attribute in the pivot table
            $product->carts()->updateExistingPivot($cart->id, [
                'quantity' => $product->pivot->quantity + $quantity
            ]);
        } else {
            // Add a new record to the cart_product table
            $cart->products()->attach($id, ['quantity' => $request->quantity]);
            $cart->total_items += 1;
        }

        $product = $cart->products()->where('product_id', $id)->first();
        $cart->subtotal += $quantity * $product->price;
        $cart->tax_value = ($cart->subtotal / 100) * 10;
        $cart->total = $cart->subtotal + $cart->tax_value;
        $cart->save();

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $quantity = $request->quantity;

        if ($id && $quantity) {
            $cart = Cart::where('user_id', Auth::id())->first();
            $cart->products()->updateExistingPivot($id, [
                'quantity' => $quantity
            ]);

            $subtotal = 0;
            foreach ($cart->products()->get() as $product) {
                $subtotal += $product->price * $product->pivot->quantity;
            }

            $cart->subtotal = $subtotal;
            $cart->tax_value = ($cart->subtotal / 100) * 10;
            $cart->total = $cart->subtotal + $cart->tax_value;
            $cart->save();

            session()->flash('success', 'Cart Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = Cart::where('user_id', Auth::id())->first();

        $product = $cart->products()->where('id', $id)->first();
        $total = $product->price * $product->pivot->quantity;

        // Remove the product from the cart
        $cart->products()->detach($id);

        $cart->total_items -= 1;
        $cart->subtotal -= $total;
        $cart->tax_value = ($cart->subtotal / 100) * 10;
        $cart->total = $cart->subtotal + $cart->tax_value;
        $cart->save();

        return redirect()->back()->with('success', 'Product removed from cart successfully!');
    }
}
