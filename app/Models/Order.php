<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'billing_name',
        'billing_email',
        'billing_address',
        'billing_city',
        'billing_postcode',
        'billing_country',
        'billing_phone',
        'billing_discount_code',
        'billing_discount_value',
        'billing_subtotal',
        'billing_tax_value',
        'billing_total'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Pivot table
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product')->withPivot('quantity')->withTimestamps();
    }
}
