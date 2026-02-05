<?php

namespace Modules\Logs\Http\Controllers;

use App\Http\Controllers\Controller;

class LogController extends Controller
{
    public function index()
    {
        return response()->json(['message' => 'Logs module']);
    }
}
