<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Inventory\InventoryController;

Route::middleware(['auth'])->prefix('inventory')->name('inventory.')->group(function () {

    // Inventory Overview
    Route::get('/', [InventoryController::class, 'index'])
        ->name('index');


    // Cards Details (نربطهم لاحقاً)
    Route::get('/stock', [InventoryController::class, 'stock'])
        ->name('stock');


    Route::get('/low-stock', [InventoryController::class, 'lowStock'])
        ->name('low-stock');


    Route::get('/out-of-stock', [InventoryController::class, 'outOfStock'])
        ->name('out-of-stock');


    Route::get('/expiring', [InventoryController::class, 'expiring'])
        ->name('expiring');


    Route::get('/expired', [InventoryController::class, 'expired'])
        ->name('expired');


    Route::get('/movements', [InventoryController::class, 'movements'])
        ->name('movements');

});