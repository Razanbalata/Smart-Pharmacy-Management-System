<?php

use App\Http\Controllers\PdfPreviewController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'active'])->group(function () {
    Route::get('/pdf/preview/{type}', [PdfPreviewController::class, 'preview'])->name('pdf.preview');
    Route::get('/pdf/download/{type}', [PdfPreviewController::class, 'download'])->name('pdf.download');
});
