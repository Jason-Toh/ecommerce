<?php

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

function presentPrice($price)
{
    return 'RM ' . number_format($price, 2, '.', '');
}

function displayImage($path)
{
    return $path && file_exists('storage/' . $path) ? asset('storage/' . $path) : asset('storage/images/image_not_found.jpg');
}

function getNumbers()
{
    $cart = Cart::where('user_id', Auth::id())->first();

    $discountCode = session()->get('coupon')['code'] ?? null;
    $discountPercent = session()->get('coupon')['percent_off'] ?? null;
    $discountValue = session()->get('coupon')['discount'] ?? 0;
    $newSubtotal = $cart->subtotal - $discountValue;
    if ($newSubtotal < 0) {
        $newSubtotal = 0;
    }

    $newTax = ($newSubtotal / 100) * 10;
    $newTotal = $newSubtotal + $newTax;

    return collect([
        'discountCode' => $discountCode,
        'discountValue' => $discountValue,
        'discountPercent' => $discountPercent,
        'newSubtotal' => $newSubtotal,
        'newTax' => $newTax,
        'newTotal' => $newTotal
    ]);
}
