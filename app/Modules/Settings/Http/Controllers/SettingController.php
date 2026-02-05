<?php

namespace Modules\Settings\Http\Controllers;

use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function index()
    {
        return response()->json(['message' => 'Settings module']);
    }
}
