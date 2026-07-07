<?php

use App\Http\Controllers\Categories\CategoryController;
use App\Http\Controllers\PharmacyController;
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

Route::middleware(['auth', 'active'])->group(function () {

    // Setup pharmacy لأول مرة
    Route::get('/pharmacy-setup', [PharmacyController::class, 'create'])
        ->name('pharmacy.setup');

    Route::post('/pharmacy-setup', [PharmacyController::class, 'store'])
        ->name('pharmacy.setup.store');

    // Settings (عرض + تعديل)
    Route::get('/pharmacy/settings', [PharmacyController::class, 'edit'])
        ->name('pharmacy.settings');

    Route::put('/pharmacy/settings', [PharmacyController::class, 'update'])
        ->name('pharmacy.settings.update');

    // (اختياري لو بدك صفحة عامة)
    Route::get('/pharmacy', [PharmacyController::class, 'index'])
        ->name('pharmacy.index');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/dashboard.php';
require __DIR__ . '/categories.php';
require __DIR__ . '/suppliers.php';
require __DIR__ . '/products.php';
require __DIR__ . '/stock.php';
require __DIR__ . '/purchases.php';
require __DIR__ . '/sales.php';
require __DIR__ . '/inventory.php';
require __DIR__ . '/reports.php';
require __DIR__ . '/users.php';
require __DIR__ . '/ai.php';
