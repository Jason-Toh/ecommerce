<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coupon = Coupon::where('code', $request->coupon_code)->first();

        if (!$coupon) {
            return back()->withErrors('Invalid coupon code. Please Try again');
        }

        $cart = Cart::where('user_id', Auth::id())->first();

        session()->put('coupon', [
            'code' => $coupon->code,
            'discount' => $coupon->discount($cart->subtotal),
            'type' => $coupon->type,
            'value_off' => $coupon->value_off,
            'percent_off' => $coupon->percent_off
        ]);

        return back()->withSuccess('Coupon has been applied');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        session()->forget('coupon');

        return back()->withSuccess('Coupon has been removed');
    }
}
