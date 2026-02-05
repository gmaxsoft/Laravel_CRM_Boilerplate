<?php

use Illuminate\Support\Facades\Route;
use Modules\Settings\Http\Controllers\CalendarCategoryController;

Route::middleware('auth')->prefix('calendar-categories')->name('settings.calendar-categories.')->group(function () {
    Route::get('/', [CalendarCategoryController::class, 'index'])->name('index');
    Route::get('/grid', [CalendarCategoryController::class, 'grid'])->name('grid');
    Route::post('/', [CalendarCategoryController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [CalendarCategoryController::class, 'edit'])->name('edit');
    Route::post('/{id}', [CalendarCategoryController::class, 'update'])->name('update');
    Route::delete('/{id}', [CalendarCategoryController::class, 'destroy'])->name('destroy');
    Route::post('/order', [CalendarCategoryController::class, 'order'])->name('order');
});
