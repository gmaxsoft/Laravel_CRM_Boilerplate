<?php

use Illuminate\Support\Facades\Route;
use Modules\Customers\Http\Controllers\CustomerController;

Route::middleware('auth')->group(function () {
    Route::get('/', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/grid', [CustomerController::class, 'grid'])->name('customers.grid');
    Route::get('/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('/store', [CustomerController::class, 'store'])->name('customers.store');
    Route::get('/edit/{id}', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::post('/update/{id}', [CustomerController::class, 'update'])->name('customers.update');
    Route::post('/delete/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
});
