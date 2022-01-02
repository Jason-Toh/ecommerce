<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Redirect to the login page
Route::redirect('/','login');

// All users can see the product page
Route::get('products', [ProductController::class, 'index'])->name('products');

// Unauthenticated users can see these routes
Route::middleware('guest')->group(function(){
    Route::get('login', [CustomAuthController::class, 'index'])->name('login');
    Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('post_login'); 
    Route::get('registration', [CustomAuthController::class, 'registration'])->name('register');
    Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('post_register'); 
});

// Authenticated users can see these routes
Route::middleware('auth')->group(function() {
    Route::get('logout', [CustomAuthController::class, 'logout'])->name('logout');
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('cart',[CartController::class,'index'])->name('cart');
    Route::get('add-to-cart/{id}', [CartController::class, 'add'])->name('add.to.cart');
    Route::post('update-cart', [CartController::class, 'update'])->name('update.cart');
    Route::get('remove-from-cart/{id}', [CartController::class, 'remove'])->name('remove.from.cart');
    // Route::get('cart',[ProductController::class,'cart'])->name('cart');
    // Route::get('add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('add.to.cart');
    // Route::get('checkout', [ProductController::class, 'checkout'])->name('checkout');
    // Route::get('remove-from-cart/{id}', [ProductController::class, 'removeFromCart'])->name('remove.from.cart');
});