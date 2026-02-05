<?php

use Illuminate\Support\Facades\Route;
use Modules\Logs\Http\Controllers\LogController;

Route::get('/', [LogController::class, 'index']);
