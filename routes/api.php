<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\Guest\ProductController as GuestProductController;
use App\Http\Controllers\Api\Guest\OrderController as GuestOrderController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->get('/users', [UserController::class, 'index']);

Route::middleware('auth:sanctum')->group(function() {
    // Product
    Route::get('/products', [ProductController::class,'index']);
    Route::get('/products/{id}', [ProductController::class,'detailProduct']);
    Route::post('/products', [ProductController::class,'saveProduct']); 
    Route::patch('/products/{id}', [ProductController::class,'saveProduct']);
    Route::delete('/products/{id}', [ProductController::class,'destroy']);

    // Order
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/orders/{id}', [OrderController::class, 'detailOrder'])->whereNumber('id');
    Route::post('/orders', [OrderController::class, 'saveOrder']);
    Route::patch('/orders/{id}', [OrderController::class, 'saveOrder']);
    Route::delete('/orders/{id}', [OrderController::class, 'destroy']);

    // Thống kê đơn hàng
    Route::get('/orders/statistics', [OrderController::class, 'statisticsOrder']);
});

Route::get('/guest/products/{user_id}', [GuestProductController::class, 'index']);
// Route::post('/guest/orders', [GuestProductController::class, 'saveOrder']);
Route::post('/guest/orders/{user_id}', [GuestOrderController::class, 'saveOrder']);


