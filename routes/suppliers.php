<?php

use App\Http\Controllers\Suppliers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::resource('suppliers', SupplierController::class);
});
