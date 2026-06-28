<?php

use App\Http\Controllers\StockMovement\StockController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'active'])->group(function () {
    Route::get('/stock/history', [StockController::class, 'history'])
        ->name('stock.history');
});
