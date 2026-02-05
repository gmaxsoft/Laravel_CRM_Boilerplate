<?php

namespace Modules\Settings\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Modules\Calendar\Models\CalendarCategory;
use Modules\Settings\Http\Requests\StoreCalendarCategoryRequest;
use Modules\Settings\Http\Requests\UpdateCalendarCategoryRequest;

class CalendarCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        $user = auth()->user();
        if (! in_array($user->user_level, [1, 2, 7])) {
            abort(403);
        }

        return view('settings::calendar-categories.index');
    }

    public function grid(): JsonResponse
    {
        $categories = DB::table('crm_calendar_category')
            ->orderBy('cal_cat_position')
            ->get();

        $data = [];
        foreach ($categories as $category) {
            $data[] = [
                'cal_cat_id' => $category->cal_cat_id,
                'cal_cat_name' => $category->cal_cat_name,
                'cal_cat_value' => $category->cal_cat_color ?? $this->getColorName($category->cal_cat_value),
                'action' => '<a class="btn btn-primary centerbtn" href="'.route('settings.calendar-categories.edit', $category->cal_cat_id).'"><i class="fas fa-pen"></i></a> <a class="btn btn-danger delete-button" data-id="'.$category->cal_cat_id.'" href="#"><i class="fas fa-trash-alt"></i></a>',
            ];
        }

        return response()->json($data);
    }

    public function create(): View
    {
        $user = auth()->user();
        if (! in_array($user->user_level, [1, 2, 7])) {
            abort(403);
        }

        // Formularz dodawania znajduje się w zakładce „Dodaj” w widoku index.
        return redirect()->route('settings.calendar-categories.index');
    }

    public function store(StoreCalendarCategoryRequest $request): JsonResponse|RedirectResponse
    {
        $maxPosition = DB::table('crm_calendar_category')->max('cal_cat_position') ?? 0;
        $position = $maxPosition + 1;

        $colorName = $this->getColorName($request->cal_cat_value);

        CalendarCategory::create([
            'cal_cat_name' => $request->cal_cat_name,
            'cal_cat_value' => $request->cal_cat_value,
            'cal_cat_color' => $colorName,
            'cal_cat_position' => $position,
            'cal_created_at' => now(),
            'cal_update_at' => now(),
        ]);

        if ($request->ajax()) {
            return response()->json(['success' => module_trans('Settings', 'messages.category_created')]);
        }

        return redirect()->route('settings.calendar-categories.index')
            ->with('success', module_trans('Settings', 'messages.category_created'));
    }

    public function edit(int $id): View
    {
        $user = auth()->user();
        if (! in_array($user->user_level, [1, 2, 7])) {
            abort(403);
        }

        $category = CalendarCategory::findOrFail($id);

        return view('settings::calendar-categories.edit', compact('category'));
    }

    public function update(UpdateCalendarCategoryRequest $request, int $id): JsonResponse|RedirectResponse
    {
        $category = CalendarCategory::findOrFail($id);

        $colorName = $this->getColorName($request->cal_cat_value);

        $category->update([
            'cal_cat_name' => $request->cal_cat_name,
            'cal_cat_value' => $request->cal_cat_value,
            'cal_cat_color' => $colorName,
            'cal_update_at' => now(),
        ]);

        if ($request->ajax()) {
            return response()->json(['success' => module_trans('Settings', 'messages.category_updated')]);
        }

        return redirect()->route('settings.calendar-categories.index')
            ->with('success', module_trans('Settings', 'messages.category_updated'));
    }

    public function destroy(int $id): JsonResponse
    {
        $category = CalendarCategory::findOrFail($id);

        $category->delete();

        return response()->json(['message' => module_trans('Settings', 'messages.category_deleted')]);
    }

    public function order(Request $request): JsonResponse
    {
        $user = auth()->user();
        if (! in_array($user->user_level, [1, 2, 7])) {
            abort(403);
        }

        $id = $request->input('id');
        $position = $request->input('position');

        CalendarCategory::where('cal_cat_id', $id)->update(['cal_cat_position' => $position]);

        return response()->json(['success' => true]);
    }

    private function getColorName(string $calCatValue): string
    {
        $colorMap = [
            'bg-primary' => 'Niebieski',
            'bg-secondary' => 'Szary',
            'bg-success' => 'Zielony',
            'bg-danger' => 'Czerwony',
            'bg-warning' => 'Żółty',
            'bg-info' => 'Seledynowy',
            'bg-light' => 'Ciemny biały',
            'bg-dark' => 'Jasny czarny',
            'bg-workshop' => 'Żółty',
        ];

        return $colorMap[$calCatValue] ?? 'Nieznany';
    }
}
