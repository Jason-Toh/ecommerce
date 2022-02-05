<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;

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
            return redirect()->route('checkout')->withErrors('Invalid coupon code. Please Try again');
        }

        session()->put('coupon', [
            'name' => $coupon->code,
            'discount' => $coupon->discount()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
