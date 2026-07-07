<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Reports\ReportController;


Route::middleware(['auth'])->prefix('reports')->name('reports.')->group(function () {


    // Reports Overview
    Route::get('/', [ReportController::class, 'index'])
        ->name('index');


    // Reports Details
    Route::get('/sales', [ReportController::class, 'sales'])
        ->name('sales');


    Route::get('/purchases', [ReportController::class, 'purchases'])
        ->name('purchases');


    Route::get('/profit', [ReportController::class, 'profit'])
        ->name('profit');


    Route::get('/inventory', [ReportController::class, 'inventory'])
        ->name('inventory');


    Route::get('/customers', [ReportController::class, 'customers'])
        ->name('customers');


    Route::get('/suppliers', [ReportController::class, 'suppliers'])
        ->name('suppliers');

});