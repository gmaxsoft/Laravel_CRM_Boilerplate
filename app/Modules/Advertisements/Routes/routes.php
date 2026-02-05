<?php

use Illuminate\Support\Facades\Route;
use Modules\Advertisements\Http\Controllers\AdvertisementController;

Route::middleware('auth')->group(function () {
    Route::get('/', [AdvertisementController::class, 'index'])->name('advertisements.index');
    Route::get('/grid', [AdvertisementController::class, 'grid'])->name('advertisements.grid');
    Route::get('/create', [AdvertisementController::class, 'create'])->name('advertisements.create');
    Route::post('/store', [AdvertisementController::class, 'store'])->name('advertisements.store');
    Route::get('/edit/{id}', [AdvertisementController::class, 'edit'])->name('advertisements.edit');
    Route::post('/update/{id}', [AdvertisementController::class, 'update'])->name('advertisements.update');
    Route::post('/delete/{id}', [AdvertisementController::class, 'destroy'])->name('advertisements.destroy');
});
