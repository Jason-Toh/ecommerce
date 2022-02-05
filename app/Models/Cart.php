<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    protected $fillable = [
        'user_id',
        'subtotal',
        'total',
        'tax_value',
        'total_items',
        'discount_value',
        'discount_code'
    ];

    private $taxrate = 10;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'cart_product')->withPivot('quantity')->withTimestamps();
    }

    public function getSubTotal()
    {
        $cart = session()->get('cart');
        $total = 0;
        foreach ($cart as $product) {
            $total += (float) $product['price'] * (float) $product['quantity'];
        }
        return $total;
    }

    public function getTotal()
    {
    }
}
