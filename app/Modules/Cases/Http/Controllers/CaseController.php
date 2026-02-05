<?php

namespace Modules\Cases\Http\Controllers;

use App\Http\Controllers\Controller;

class CaseController extends Controller
{
    public function index()
    {
        return response()->json(['message' => 'Cases module']);
    }
}
