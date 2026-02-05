<?php

use Illuminate\Support\Facades\Route;
use Modules\Access\Http\Controllers\AccessController;

Route::middleware('auth')->group(function () {
    Route::get('/', [AccessController::class, 'index'])->name('access.index');
    Route::get('/grid', [AccessController::class, 'grid'])->name('access.grid');
    Route::get('/create', [AccessController::class, 'create'])->name('access.create');
    Route::post('/store', [AccessController::class, 'store'])->name('access.store');
    Route::get('/edit/{id}', [AccessController::class, 'edit'])->name('access.edit');
    Route::post('/update/{id}', [AccessController::class, 'update'])->name('access.update');
    Route::post('/delete/{id}', [AccessController::class, 'destroy'])->name('access.destroy');
});
