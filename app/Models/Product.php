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
        'name', 'price', 'description', 'image'
    ];

    public function orders(){
        return $this->belongsToMany(Order::class, 'order_product')->withPivot('quantity');
    }
}
