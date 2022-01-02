<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    /*
        Fillable means what columns in the table are allowed to be inserted, 
        guarded means the model can't insert to that particular column.

        https://stackoverflow.com/questions/22279435/what-does-mass-assignment-mean-in-laravel
     */
    protected $fillable = ['total_cost','user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function products(){
        return $this->belongsToMany(Product::class,'order_product')->withPivot('quantity');
    }
}
