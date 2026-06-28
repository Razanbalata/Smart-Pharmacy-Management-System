<?php

use App\Http\Controllers\Categories\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'active'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
require __DIR__.'/dashboard.php';
require __DIR__.'/categories.php';
require __DIR__.'/suppliers.php';
require __DIR__.'/products.php';
require __DIR__.'/stock.php';
require __DIR__.'/purchases.php';
require __DIR__.'/sales.php';
require __DIR__.'/inventory.php';
require __DIR__.'/reports.php';
require __DIR__.'/users.php';
require __DIR__.'/ai.php';
