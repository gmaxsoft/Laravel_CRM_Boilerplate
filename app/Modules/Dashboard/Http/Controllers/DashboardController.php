<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Modules\Advertisements\Models\Advertisement;
use Modules\Calendar\Models\Calendar;
use Modules\Customers\Models\Customer;
use Modules\Users\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $stats = Cache::remember('dashboard.stats', now()->addMinutes(5), function () {
            return [
                'customers' => Customer::query()->count(),
                'advertisements' => Advertisement::query()->where('adv_magazyn_type', '0')->count(),
                'calendar_events' => Calendar::query()->count(),
                'users' => User::query()->count(),
            ];
        });

        return view('dashboard.index', [
            'user' => $user,
            'stats' => $stats,
        ]);
    }
}
