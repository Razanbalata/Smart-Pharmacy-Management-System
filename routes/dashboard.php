<?php

use App\Http\Controllers\Inventory\InventoryReportController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [InventoryReportController::class, 'dashboard'])->middleware(['auth', 'verified', 'active'])->name('dashboard');
