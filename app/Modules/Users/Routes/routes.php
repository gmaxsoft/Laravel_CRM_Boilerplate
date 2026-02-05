<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\UserController;

Route::middleware('auth')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::get('/grid', [UserController::class, 'grid'])->name('users.grid');
    Route::get('/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/update/{user}', [UserController::class, 'update'])->name('users.update');
    Route::post('/update-password/{user}', [UserController::class, 'updatePassword'])->name('users.update-password');
    Route::post('/delete/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});
