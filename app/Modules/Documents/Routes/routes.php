<?php

use Illuminate\Support\Facades\Route;
use Modules\Documents\Http\Controllers\DocumentController;

Route::middleware('auth')->group(function () {
    Route::get('/', [DocumentController::class, 'index'])->name('documents.index');
    Route::get('/grid', [DocumentController::class, 'grid'])->name('documents.grid');
    Route::post('/store', [DocumentController::class, 'store'])->name('documents.store');
    Route::get('/download/{id}', [DocumentController::class, 'download'])->name('documents.download');
    Route::post('/delete/{id}', [DocumentController::class, 'destroy'])->name('documents.destroy');
});
