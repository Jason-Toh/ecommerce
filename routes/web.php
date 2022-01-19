<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;

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
Route::redirect('/', 'dashboard');
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

// All users can see the product page
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products');
    Route::get('details', [ProductController::class, 'show'])->name('products.details');
});

Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart');
    Route::get('add/{id}', [CartController::class, 'add'])->name('add.to.cart');
    Route::post('update', [CartController::class, 'update'])->name('update.cart');
    Route::get('remove/{id}', [CartController::class, 'remove'])->name('remove.from.cart');
});

// Unauthenticated users can see these routes
Route::middleware('guest')->group(function () {
    Route::get('login', [CustomAuthController::class, 'index'])->name('login');
    Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('post_login');
    Route::get('registration', [CustomAuthController::class, 'registration'])->name('register');
    Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('post_register');
});

// Authenticated users can see these routes
Route::middleware('auth')->group(function () {
    Route::get('logout', [CustomAuthController::class, 'logout'])->name('logout');
    // Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::prefix('order')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('orders');
        Route::post('store', [OrderController::class, 'store'])->name('orders.store');
    });
});
