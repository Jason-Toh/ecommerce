<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = Product::inRandomOrder()->take(5)->get();
        $products = Product::where('featured', true)->inRandomOrder()->take(5)->get();
        return view('dashboard.index', compact('products'));
    }
}
