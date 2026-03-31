<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryProductsController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\OrderController as FrontOrderController;
use App\Http\Controllers\MenuController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [MenuController::class, 'index']);
// Route::post('/order', [OrderController::class, 'store']);
Route::post('/order', [FrontOrderController::class, 'store'])->name('order.store');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [IndexController::class, 'index']);
    Route::get('/dashboard', [IndexController::class, 'index']);
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    Route::resource('productsCategories', CategoryProductsController::class);
    Route::resource('orders', AdminOrderController::class);
});
