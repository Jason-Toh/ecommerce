<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CouponController;
use TCG\Voyager\Facades\Voyager;

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

// Redirect to the dashboard page
Route::redirect('home', 'dashboard');
Route::redirect('/', 'dashboard');
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/show/{slug}', [ProductController::class, 'show'])->name('products.show');
    Route::get('search', [ProductController::class, 'search'])->name('products.search');
    Route::get('filter', [ProductController::class, 'filter'])->name('products.filter');
});

// Unauthenticated users can see these routes
Route::middleware('guest')->group(function () {
    Route::prefix('login')->group(function () {
        Route::get('/', [CustomAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/', [CustomAuthController::class, 'postLogin'])->name('login.store');
    });

    Route::prefix('register')->group(function () {
        Route::get('/', [CustomAuthController::class, 'showRegisterForm'])->name('register');
        Route::post('/', [CustomAuthController::class, 'postRegister'])->name('register.store');
    });
});

// Authenticated users can see these routes
Route::middleware('auth')->group(function () {
    Route::get('logout', [CustomAuthController::class, 'logout'])->name('logout');

    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
        Route::post('/', [CartController::class, 'store'])->name('cart.store');
        Route::patch('{id}', [CartController::class, 'update'])->name('cart.update');
        Route::delete('{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    });

    Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout.index');

    Route::prefix('coupons')->group(function () {
        Route::post('/', [CouponController::class, 'store'])->name('coupons.store');
        Route::delete('/', [CouponController::class, 'destroy'])->name('coupons.destroy');
    });

    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('orders.index');
        Route::post('/', [OrderController::class, 'store'])->name('orders.store');
    });
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
