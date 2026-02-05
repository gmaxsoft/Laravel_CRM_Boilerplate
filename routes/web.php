<?php

use Illuminate\Support\Facades\Route;

// Strona główna: zalogowani → dashboard, goście → logowanie
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    return redirect()->route('login');
});
