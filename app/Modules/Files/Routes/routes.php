<?php

use Illuminate\Support\Facades\Route;
use Modules\Files\Http\Controllers\FileController;

Route::get('/', [FileController::class, 'index']);
