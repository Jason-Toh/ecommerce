<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    // What can be inserted into the table
    protected $fillable = [
        'name',
        'slug',
        'price',
        'description',
        'image'
    ];

    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_product')->withPivot('quantity')->withTimestamps();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product')->withTimestamps();
    }

    // Pivot table
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product')->withPivot('quantity')->withTimestamps();
    }
}
