<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartProductController;
use App\Http\Controllers\CategoryController;

use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderProductController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::post('/register', [AuthController::class, 'store'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::apiResources([
        'addresses' => AddressController::class,
        'brands' => BrandController::class,
        'categories' => CategoryController::class,
        'products' => ProductController::class,
        'orders' => OrderController::class,
        'order-products' => OrderProductController::class,
        'cart-products' => CartProductController::class
    ]);
});
