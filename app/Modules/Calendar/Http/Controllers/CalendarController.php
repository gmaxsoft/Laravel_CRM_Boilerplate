<?php

namespace Modules\Calendar\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Modules\Calendar\Http\Requests\StoreCalendarRequest;
use Modules\Calendar\Http\Requests\UpdateCalendarRequest;
use Modules\Calendar\Models\Calendar;

class CalendarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        $categories = Cache::remember('crm_calendar_category_list', now()->addHours(24), function () {
            return DB::table('crm_calendar_category')->orderBy('cal_cat_position')->get();
        });

        return view('calendar::index', [
            'categories' => $categories,
        ]);
    }

    public function json()
    {
        $user = auth()->user();
        $level = $user->user_level;
        $userId = $user->id;

        if (in_array($level, [1, 2, 7])) {
            $events = Calendar::orderBy('created_at', 'desc')->get();
        } else {
            $events = Calendar::where('cal_user_id', $userId)->orderBy('created_at', 'desc')->get();
        }

        $json = [];

        foreach ($events as $event) {
            $json[] = [
                'title' => $event->cal_name,
                'start' => $event->cal_start ? date('Y-m-d H:i:s', strtotime($event->cal_start)) : null,
                'end' => $event->cal_end ? date('Y-m-d H:i:s', strtotime($event->cal_end)) : null,
                'className' => $event->cal_category,
                'id' => $event->cal_id,
                'groupId' => $event->cal_user_id,
                'description' => $event->cal_annotations ?? '',
                'extendedProps' => [
                    'description' => $event->cal_annotations ?? '',
                ],
            ];
        }

        return response()->json($json);
    }

    public function grid()
    {
        $user = auth()->user();
        $level = $user->user_level;
        $userId = $user->id;

        if (in_array($level, [1, 2])) {
            $events = Calendar::with('user')->orderBy('created_at', 'desc')->get();
        } else {
            $events = Calendar::where('cal_user_id', $userId)->with('user')->orderBy('created_at', 'desc')->get();
        }

        // Cache categories lookup to avoid N+1 queries
        $categories = Cache::remember('crm_calendar_category', now()->addHours(24), function () {
            return DB::table('crm_calendar_category')->pluck('cal_cat_name', 'cal_cat_value')->toArray();
        });

        $lp = 0;
        $json = [];

        foreach ($events as $row) {
            $lp++;

            $category = $categories[$row->cal_category] ?? $row->cal_category;

            $userName = $row->user ? $row->user->first_name.' '.$row->user->last_name : '';

            $action = '<a class="btn btn-primary" href="/module/calendar/edit/'.$row->cal_id.'"><i class="fas fa-pen"></i></a>';
            $action .= '&nbsp;<a class="btn btn-danger delete-button" data-id="'.$row->cal_id.'" href="#"><i class="fas fa-trash-alt"></i></a>';

            $json[] = [
                'state' => '<input data-index="'.$row->cal_id.'" name="btSelectItem" class="checkedbox" type="checkbox">',
                'lp' => $lp,
                'cal_id' => $row->cal_id,
                'cal_name' => $row->cal_name ?? '',
                'cal_category' => $category,
                'cal_start' => $row->cal_start ?? '',
                'cal_end' => $row->cal_end ?? '',
                'cal_annotations' => $row->cal_annotations ?? '',
                'cal_user_id' => $userName,
                'created_at' => $row->created_at ?? '',
                'action' => $action,
            ];
        }

        return response()->json($json);
    }

    public function store(StoreCalendarRequest $request)
    {
        $start = str_replace('T', ' ', $request->start);
        $end = str_replace('T', ' ', $request->end);

        Calendar::create([
            'cal_name' => $request->title,
            'cal_category' => $request->category,
            'cal_start' => date('Y-m-d H:i:s', strtotime($start)),
            'cal_end' => date('Y-m-d H:i:s', strtotime($end)),
            'cal_annotations' => $request->annotations,
            'cal_user_id' => auth()->id(),
            'created_at' => now(),
        ]);

        return response(module_trans('Calendar', 'success.created'), 200)
            ->header('Content-Type', 'text/plain');
    }

    public function update(UpdateCalendarRequest $request, $id)
    {
        $event = Calendar::findOrFail($id);

        $start = str_replace('T', ' ', $request->start);
        $end = str_replace('T', ' ', $request->end);

        $event->update([
            'cal_name' => $request->title,
            'cal_category' => $request->category,
            'cal_start' => date('Y-m-d H:i:s', strtotime($start)),
            'cal_end' => date('Y-m-d H:i:s', strtotime($end)),
            'cal_annotations' => $request->annotations,
            'update_at' => now(),
        ]);

        return response(module_trans('Calendar', 'success.updated'), 200)
            ->header('Content-Type', 'text/plain');
    }

    public function destroy($id)
    {
        $user = auth()->user();
        $event = Calendar::findOrFail($id);

        // Sprawdź uprawnienia - tylko właściciel lub admin może usunąć
        if (! in_array($user->user_level, [1, 2]) && $event->cal_user_id != $user->id) {
            abort(403);
        }

        $event->delete();

        return response(module_trans('Calendar', 'success.deleted'), 200)
            ->header('Content-Type', 'text/plain');
    }
}
