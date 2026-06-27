<?php


use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'active'])->group(function () {

    Route::middleware('can:isAdmin')->group(function () {
        Route::resource('users', UserController::class);
    });
});
