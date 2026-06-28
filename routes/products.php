<?php

use App\Http\Controllers\Products\ProductController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'active'])->group(function () {
    Route::get('/products/low-stock', [ProductController::class, 'lowStock'])
        ->name('products.low-stock');
    Route::resource('products', ProductController::class);
});
