<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = Product::all();
        $products = DB::table('products');
        $pagination = 9;
        $categories = Category::all();
        $categoryName = 'Featured';
        if (request()->category) {
            // Eager loading
            // $products = Product::with('categories')->whereHas('categories', function ($query) {
            //     $query->where('slug', request()->category);
            // })->get();

            // Same as above
            $products = Product::with('categories')->whereRelation('categories', 'slug', request()->category);
            $categoryName = $categories->where('slug', request()->category)->first()->name;
        }

        if (request()->sort == 'low_high') {
            $products = $products->orderBy('price')->paginate($pagination);
        } elseif (request()->sort == 'high_low') {
            $products = $products->orderBy('price', 'desc')->paginate($pagination);
        } else {
            $products = $products->paginate($pagination);
        }

        return view('products')->with([
            'products' => $products,
            'categories' => $categories,
            'categoryName' => $categoryName
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('details')->with('product', $product);
    }
}
