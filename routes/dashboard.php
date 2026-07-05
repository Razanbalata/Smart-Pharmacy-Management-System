<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Inventory\InventoryReportController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified', 'active'])->name('dashboard');
