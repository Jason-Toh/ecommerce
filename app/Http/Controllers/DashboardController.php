<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliderImages = $this->getSliderImages();

        $products = Product::where('featured', true)->inRandomOrder()->take(5)->get();
        return view('dashboard.index', compact('products', 'sliderImages'));
    }

    public function getSliderImages()
    {
        $path = public_path('images/slider');
        $files = File::files($path);
        $sliderImages = [];
        foreach ($files as $file) {
            $sliderImages[] = '\images\slider\\' . $file->getRelativePathname();
        }

        return $sliderImages;
    }
}
