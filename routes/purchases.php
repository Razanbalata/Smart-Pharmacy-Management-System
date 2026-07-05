<?php

use App\Http\Controllers\Purchases\PurchaseOrderController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'active','pharmacy'])->group(function () {

    Route::get('/purchases', [PurchaseOrderController::class, 'index'])->name('purchase.index');
    Route::get('/purchases/create', [PurchaseOrderController::class, 'create'])->name('purchase.create');
    Route::post('/purchases', [PurchaseOrderController::class, 'store'])->name('purchase.store');
    Route::get('/purchases/{order}/edit', [PurchaseOrderController::class, 'edit'])->name('purchase.edit');

    Route::post('/purchases/{order}/add-item', [PurchaseOrderController::class, 'addItem'])->name('purchase.addItem');
    Route::post('/purchases/{order}/receive', [PurchaseOrderController::class, 'receive'])->name('purchase.receive');
});
