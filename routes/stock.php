<?php

use App\Http\Controllers\StockMovement\StockController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'active','pharmacy'])->group(function () {
    Route::get('/stock/history', [StockController::class, 'history'])
        ->name('stock.history');
    Route::get('/stock/adjust', [StockController::class, 'showAdjustForm'])
        ->name('stock.adjust.form');

    Route::post('/stock/adjust', [StockController::class, 'adjust'])
        ->name('stock.adjust');
});
