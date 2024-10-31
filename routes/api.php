<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::apiResource('products',ProductController::class)->only(['index','store']);
Route::post('orders', [OrderController::class, 'store']);
