<?php

use App\Http\Controllers\AI\AIController;
use App\Http\Controllers\AI\ChatController;
use Illuminate\Support\Facades\Route;

Route::get(
    '/ai/analyze',
    [AIController::class, 'analyze']
)->middleware(['auth', 'active', 'pharmacy'])->name('ai.analyze');

Route::middleware('auth')
    ->prefix('ai')
    ->group(function () {
        Route::get(
            '/chat',
            [ChatController::class, 'index']
        )
            ->name('ai.chat');

        Route::post(
            '/chat/message',
            [ChatController::class, 'message']
        )
            ->name('ai.chat.message');
    });
