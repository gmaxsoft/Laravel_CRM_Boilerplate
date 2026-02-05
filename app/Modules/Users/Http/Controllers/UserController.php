<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Modules\Access\Models\Access;
use Modules\Users\Http\Requests\StoreUserRequest;
use Modules\Users\Http\Requests\UpdatePasswordRequest;
use Modules\Users\Http\Requests\UpdateUserRequest;
use Modules\Users\Models\User;

class UserController extends Controller
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
        $accessLevels = Cache::remember('access_levels', now()->addHours(24), function () {
            return Access::orderBy('level', 'asc')->get();
        });

        return view('users::index', [
            'canAdd' => $canAdd,
            'canDelete' => $canDelete,
            'accessLevels' => $accessLevels,
        ]);
    }

    public function grid()
    {
        $user = auth()->user();
        $level = $user->user_level;
        $userId = $user->id;

        if (in_array($level, [1, 2])) {
            $users = User::with('access')->orderBy('id', 'asc')->get();
        } else {
            $users = User::with('access')->where('id', $userId)->orderBy('id', 'asc')->get();
        }

        $lp = 0;
        $json = [];

        foreach ($users as $row) {
            $lp++;
            $userLevelName = $row->access ? $row->access->name : '-';
            $symbol = $row->symbol ?: '-';
            $standName = $row->stand_name ?: '-';

            $state = '<input data-index="'.$row->id.'" name="btSelectItem" type="checkbox">';

            if (in_array($level, [1, 2, 7])) {
                $action = '<a class="btn btn-info" href="/module/users/edit/'.$row->id.'"><i class="fas fa-pen"></i></a>&nbsp;<a class="btn btn-danger delete-button" data-id="'.$row->id.'" href="#"><i class="fas fa-trash-alt"></i></a>';
            } else {
                $action = '<a class="btn btn-info" href="/module/users/edit/'.$row->id.'"><i class="fas fa-pen"></i></a>';
            }

            $json[] = [
                'state' => $state,
                'action' => $action,
                'lp' => $lp,
                'user_id' => $row->id,
                'first_name' => $row->first_name,
                'last_name' => $row->last_name,
                'stand_name' => $standName,
                'user_level' => $userLevelName,
                'email' => $row->email,
                'phone' => $row->phone ?: '-',
                'symbol' => $symbol,
                'department' => $row->department ?: '-',
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

        $accessLevels = Cache::remember('access_levels', now()->addHours(24), function () {
            return Access::orderBy('level', 'asc')->get();
        });

        return view('users::create', [
            'accessLevels' => $accessLevels,
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'stand_name' => $request->stand_name,
            'symbol' => $request->symbol,
            'user_level' => $request->user_level,
            'email' => $request->email,
            'phone' => $request->phone,
            'department' => $request->department,
            'description' => $request->description,
            'password' => Hash::make($request->password),
            'active' => '1',
        ]);

        return response(module_trans('Users', 'success.created'), 200)
            ->header('Content-Type', 'text/plain');
    }

    public function edit($id)
    {
        $user = auth()->user();
        $editUser = User::findOrFail($id);

        // Sprawdzenie uprawnień
        if (! in_array($user->user_level, [1, 2, 7]) && $user->id != $id) {
            abort(403);
        }

        $accessLevels = Cache::remember('access_levels', now()->addHours(24), function () {
            return Access::orderBy('level', 'asc')->get();
        });
        $canChangeLevel = in_array($user->user_level, [1, 2, 7]);

        return view('users::edit', [
            'user' => $editUser,
            'accessLevels' => $accessLevels,
            'canChangeLevel' => $canChangeLevel,
        ]);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'stand_name' => $request->stand_name,
            'symbol' => $request->symbol,
            'email' => $request->email,
            'phone' => $request->phone,
            'department' => $request->department,
            'description' => $request->description,
        ]);

        // Tylko admini mogą zmieniać poziom uprawnień
        $currentUser = auth()->user();
        if (in_array($currentUser->user_level, [1, 2, 7]) && $request->has('user_level')) {
            $user->user_level = $request->user_level;
            $user->save();
        }

        return response(module_trans('Users', 'success.updated'), 200)
            ->header('Content-Type', 'text/plain');
    }

    public function updatePassword(UpdatePasswordRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return response(module_trans('Users', 'success.password_updated'), 200)
            ->header('Content-Type', 'text/plain');
    }

    public function destroy($id)
    {
        $user = auth()->user();

        if (! in_array($user->user_level, [1, 2])) {
            abort(403);
        }

        $deleteUser = User::findOrFail($id);
        $deleteUser->delete();

        return response(module_trans('Users', 'success.deleted'), 200)
            ->header('Content-Type', 'text/plain');
    }
}
