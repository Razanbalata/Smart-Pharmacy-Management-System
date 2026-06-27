<?php

use App\Http\Controllers\Products\ProductController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth','active'])->group(function () {
    Route::resource('products', ProductController::class);
});