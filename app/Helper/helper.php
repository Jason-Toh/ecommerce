<?php

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

// global function
// composer.jspn
/* 1) "autoload": {
        "files": [
            "app/Helper/helper.php" <-- add here
        ],
        "psr-4": {
            "App\\": "app/",
            "Database\\Factories\\": "database/factories/",
            "Database\\Seeders\\": "database/seeders/"
        }
    },
*/
// 2) composer dump-autoload

function presentPrice($price)
{
    return 'RM ' . number_format($price, 2, '.', '');
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
