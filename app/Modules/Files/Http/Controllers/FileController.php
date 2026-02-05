<?php

namespace Modules\Files\Http\Controllers;

use App\Http\Controllers\Controller;

class FileController extends Controller
{
    public function index()
    {
        return response()->json(['message' => 'Files module']);
    }
}
