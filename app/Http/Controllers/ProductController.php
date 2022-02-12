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

        list($products, $categories, $categoryName, $minPrice, $maxPrice) = $this->getSideBar($products);

        return view('products.index')->with([
            'products' => $products,
            'categories' => $categories,
            'categoryName' => $categoryName,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice
        ]);
    }

    public function getSideBar($products)
    {
        $pagination = 9;
        $categories = Category::all();
        $categoryName = 'Featured';
        $minPrice = 1;
        $maxPrice = 1000;
        if (request()->category) {
            // Eager loading
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
        return array($products, $categories, $categoryName, $minPrice, $maxPrice);
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
        return view('products.show')->with('product', $product);
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $products = Product::where('name', 'like', '%' . $query . '%');

        list($products, $categories, $categoryName, $minPrice, $maxPrice) = $this->getSideBar($products);

        return view('products.index')->with([
            'products' => $products,
            'categories' => $categories,
            'categoryName' => null,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
            'searchQuery' => $query,
        ]);
    }

    public function priceFilter(Request $request)
    {
        $minPrice = $request->minPrice;
        $maxPrice = $request->maxPrice;

        $products = Product::whereBetween('price', [$minPrice, $maxPrice]);

        list($products, $categories, $categoryName, $_, $_) = $this->getSideBar($products);

        return view('products.index')->with([
            'products' => $products,
            'categories' => $categories,
            'categoryName' => $categoryName,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice
        ]);
    }
}
