<?php

use Illuminate\Support\Facades\Route;
use Modules\Cases\Http\Controllers\CaseController;

Route::get('/', [CaseController::class, 'index']);
