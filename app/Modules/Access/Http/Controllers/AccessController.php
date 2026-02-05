<?php

namespace Modules\Access\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Access\Http\Requests\StoreAccessRequest;
use Modules\Access\Http\Requests\UpdateAccessRequest;
use Modules\Access\Models\Access;

class AccessController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        $canAdd = in_array($user->user_level, [1, 2, 7]);
        $canDelete = in_array($user->user_level, [1, 2]);

        return view('access::index', [
            'canAdd' => $canAdd,
            'canDelete' => $canDelete,
        ]);
    }

    public function grid()
    {
        $user = auth()->user();
        $level = $user->user_level;

        if (! in_array($level, [1, 2, 7])) {
            abort(403);
        }

        $accesses = Access::orderBy('position', 'desc')->get();

        $json = [];

        foreach ($accesses as $row) {
            $action = '<a class="btn btn-primary" href="/module/access/edit/'.$row->id.'"><i class="fas fa-pen"></i></a>';

            if (in_array($level, [1, 2])) {
                $action .= '&nbsp;<a class="btn btn-danger delete-button" data-id="'.$row->id.'" href="#"><i class="fas fa-trash-alt"></i></a>';
            }

            $json[] = [
                'id' => $row->id,
                'name' => $row->name,
                'level' => $row->level,
                'action' => $action,
            ];
        }

        return response()->json($json);
    }

    public function create()
    {
        $user = auth()->user();

        if (! in_array($user->user_level, [1, 2, 7])) {
            abort(403);
        }

        return view('access::create');
    }

    public function store(StoreAccessRequest $request)
    {
        $maxPosition = Access::max('position') ?? 0;
        $position = $maxPosition + 1;

        Access::create([
            'name' => $request->name,
            'level' => $request->level,
            'position' => $position,
            'created_at' => now(),
        ]);

        return response(module_trans('Access', 'success.created'), 200)
            ->header('Content-Type', 'text/plain');
    }

    public function edit($id)
    {
        $user = auth()->user();

        if (! in_array($user->user_level, [1, 2, 7])) {
            abort(403);
        }

        $access = Access::findOrFail($id);

        return view('access::edit', [
            'access' => $access,
        ]);
    }

    public function update(UpdateAccessRequest $request, $id)
    {
        $access = Access::findOrFail($id);

        $access->update([
            'name' => $request->name,
            'level' => $request->level,
            'update_at' => now(),
        ]);

        return response(module_trans('Access', 'success.updated'), 200)
            ->header('Content-Type', 'text/plain');
    }

    public function destroy($id)
    {
        $user = auth()->user();

        if (! in_array($user->user_level, [1, 2])) {
            abort(403);
        }

        $access = Access::findOrFail($id);
        $access->delete();

        return response(module_trans('Access', 'success.deleted'), 200)
            ->header('Content-Type', 'text/plain');
    }
}
