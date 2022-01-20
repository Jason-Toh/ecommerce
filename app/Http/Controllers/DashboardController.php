<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::inRandomOrder()->take(5)->get();
        return view('dashboard', compact('products'));
    }
}
