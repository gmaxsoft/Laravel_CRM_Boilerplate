<?php

use Illuminate\Support\Facades\Route;
use Modules\Calendar\Http\Controllers\CalendarController;

Route::middleware('auth')->group(function () {
    Route::get('/', [CalendarController::class, 'index'])->name('calendar.index');
    Route::get('/json', [CalendarController::class, 'json'])->name('calendar.json');
    Route::get('/grid', [CalendarController::class, 'grid'])->name('calendar.grid');
    Route::post('/store', [CalendarController::class, 'store'])->name('calendar.store');
    Route::post('/update/{id}', [CalendarController::class, 'update'])->name('calendar.update');
    Route::post('/delete/{id}', [CalendarController::class, 'destroy'])->name('calendar.destroy');
});
