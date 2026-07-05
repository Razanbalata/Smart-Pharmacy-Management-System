<?php

use App\Http\Controllers\Sales\SaleController;
use Illuminate\Support\Facades\Route;

Route::prefix('sales')->name('sales.')->group(function () {

    Route::get('/', [SaleController::class, 'index'])->name('index');

    Route::get('/create', [SaleController::class, 'create'])->name('create');

    Route::get('/{sale}/edit', [SaleController::class, 'edit'])->name('edit');

    Route::post('/{sale}/items', [SaleController::class, 'addItem'])->name('items.store');

    Route::delete('/items/{item}', [SaleController::class, 'removeItem'])->name('items.destroy');

    Route::post('/{sale}/complete', [SaleController::class, 'complete'])->name('complete');

    Route::post('/{sale}/cancel', [SaleController::class, 'cancel'])->name('cancel');
})->middleware(['auth', 'active','pharmacy']);