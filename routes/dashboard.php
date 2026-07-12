<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Inventory\InventoryReportController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'active', 'pharmacy'])
    ->group(function () {
        Route::get(
            '/dashboard',
            [DashboardController::class, 'index']
        )
            ->name('dashboard');

        Route::get(
            '/dashboard/sales-trend',
            [DashboardController::class, 'salesTrend']
        )
            ->name('dashboard.salesTrend');
    });
