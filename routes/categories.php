<?php

use App\Http\Controllers\Categories\CategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'active','pharmacy'])->group(function () {
    Route::resource('categories', CategoryController::class);
});