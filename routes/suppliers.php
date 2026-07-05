<?php

use App\Http\Controllers\Suppliers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'active','pharmacy'])->group(function () {
    Route::resource('suppliers', SupplierController::class);
});
