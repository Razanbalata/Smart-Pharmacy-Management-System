<?php

use App\Http\Controllers\AI\AIController;
use Illuminate\Support\Facades\Route;

Route::get(
    '/ai/analyze',
    [AIController::class, 'analyze']
)->middleware(['auth', 'active', 'pharmacy'])->name('ai.analyze');
