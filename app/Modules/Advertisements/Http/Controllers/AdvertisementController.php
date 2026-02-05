<?php

namespace Modules\Advertisements\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Modules\Advertisements\Http\Requests\StoreAdvertisementRequest;
use Modules\Advertisements\Http\Requests\UpdateAdvertisementRequest;
use Modules\Advertisements\Models\Advertisement;
use Modules\Users\Models\User;

class AdvertisementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        $canAdd = in_array($user->user_level, [1, 2, 7]);
        $canDelete = in_array($user->user_level, [1, 2, 7]);

        $machines = Cache::remember('crm_machines_list', now()->addHours(24), function () {
            return DB::table('crm_machines')->orderBy('position')->get();
        });
        $producers = Cache::remember('crm_producers_list', now()->addHours(24), function () {
            return DB::table('crm_producers')->orderBy('position')->get();
        });
        $locations = Cache::remember('crm_location_list', now()->addHours(24), function () {
            return DB::table('crm_location')->orderBy('position')->get();
        });
        $stans = Cache::remember('crm_stan_list', now()->addHours(24), function () {
            return DB::table('crm_stan')->orderBy('position')->get();
        });
        $traders = Cache::remember('users_traders', now()->addMinutes(30), function () {
            return User::whereIn('user_level', [1, 5, 6, 7])->orderBy('first_name')->get();
        });

        return view('advertisements::index', [
            'canAdd' => $canAdd,
            'canDelete' => $canDelete,
            'machines' => $machines,
            'producers' => $producers,
            'locations' => $locations,
            'stans' => $stans,
            'traders' => $traders,
        ]);
    }

    public function grid()
    {
        $advertisements = Advertisement::where('adv_magazyn_type', '0')
            ->with('reservationUser')
            ->orderBy('adv_position', 'desc')
            ->get();

        // Cache lookup tables to avoid N+1 queries
        $machines = Cache::remember('crm_machines', now()->addHours(24), function () {
            return DB::table('crm_machines')->pluck('name', 'id')->toArray();
        });

        $producers = Cache::remember('crm_producers', now()->addHours(24), function () {
            return DB::table('crm_producers')->pluck('name', 'id')->toArray();
        });

        $lp = 0;
        $json = [];

        foreach ($advertisements as $row) {
            $lp++;

            $machineType = $machines[$row->adv_machine_type] ?? '';
            $producerName = $producers[$row->adv_producer] ?? '';
            $traderName = $row->reservationUser
                ? $row->reservationUser->first_name.' '.$row->reservationUser->last_name
                : '';

            $reservationText = match ($row->adv_reservation) {
                0 => 'Wyświetlone',
                1 => 'Rezerwacja',
                2 => 'Wkrótce',
                3 => 'Do Akceptacji',
                4 => 'Nie wyświetlone',
                default => '',
            };

            $action = '<a class="btn btn-primary" href="/module/advertisements/edit/'.$row->adv_id.'"><i class="fas fa-pen"></i></a>';

            if (in_array(auth()->user()->user_level, [1, 2, 7])) {
                $action .= '&nbsp;<a class="btn btn-danger delete-button" data-id="'.$row->adv_id.'" href="#"><i class="fas fa-trash-alt"></i></a>';
            }

            $json[] = [
                'state' => '<input data-index="'.$row->adv_id.'" name="btSelectItem" class="checkedbox" type="checkbox">',
                'lp' => $lp,
                'adv_id' => $row->adv_id,
                'action' => $action,
                'adv_status' => $row->adv_status ?? '',
                'adv_reservation' => $reservationText,
                'adv_client_name' => $row->adv_client_name ?? '',
                'adv_machine_type' => $machineType,
                'adv_producer' => $producerName,
                'adv_model' => $row->adv_model ?? '',
                'adv_year' => $row->adv_year ?? '',
                'adv_internal_order_number' => $row->adv_internal_order_number ?? '',
                'adv_producer_order_number' => $row->adv_producer_order_number ?? '',
                'adv_serial_number' => $row->adv_serial_number ?? '',
                'adv_state' => $row->adv_state ?? '',
                'adv_reservation_user_id' => $traderName,
                'adv_location' => $row->adv_location ?? '',
                'adv_production_date' => $row->adv_production_date ?? '',
                'adv_price_netto' => $row->adv_price_netto ?? '',
                'adv_price' => $row->adv_price ?? '',
                'adv_register' => $row->adv_register ?? '',
                'adv_comments' => $row->adv_comments ?? '',
                'adv_warranty_start' => $row->adv_warranty_start ?? '',
                'adv_warranty_end' => $row->adv_warranty_end ?? '',
                'adv_order_price' => $row->adv_order_price ?? '',
                'adv_order_date' => $row->adv_order_date ?? '',
                'adv_fv_nr' => $row->adv_fv_nr ?? '',
                'adv_created_at' => $row->adv_created_at ?? '',
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

        $machines = Cache::remember('crm_machines_list', now()->addHours(24), function () {
            return DB::table('crm_machines')->orderBy('position')->get();
        });
        $producers = Cache::remember('crm_producers_list', now()->addHours(24), function () {
            return DB::table('crm_producers')->orderBy('position')->get();
        });
        $locations = Cache::remember('crm_location_list', now()->addHours(24), function () {
            return DB::table('crm_location')->orderBy('position')->get();
        });
        $stans = Cache::remember('crm_stan_list', now()->addHours(24), function () {
            return DB::table('crm_stan')->orderBy('position')->get();
        });

        return view('advertisements::create', [
            'machines' => $machines,
            'producers' => $producers,
            'locations' => $locations,
            'stans' => $stans,
        ]);
    }

    public function store(StoreAdvertisementRequest $request)
    {
        $maxPosition = Advertisement::where('adv_magazyn_type', '0')->max('adv_position') ?? 0;
        $position = $maxPosition + 1;

        $machines = Cache::remember('crm_machines', now()->addHours(24), function () {
            return DB::table('crm_machines')->pluck('name', 'id')->toArray();
        });
        $producers = Cache::remember('crm_producers', now()->addHours(24), function () {
            return DB::table('crm_producers')->pluck('name', 'id')->toArray();
        });

        $machineTypeName = $machines[$request->adv_machine_type] ?? '';
        $producerName = $producers[$request->adv_producer] ?? '';
        $machineName = trim($machineTypeName.' '.$producerName.' '.$request->adv_model);

        $reservation = $request->adv_reservation;
        $active = ($reservation == 2) ? '0' : '1';

        $status = match ($reservation) {
            1 => 'Rezerwacja',
            2 => 'Wkrótce',
            0 => 'Wolne',
            default => 'Wolne',
        };

        Advertisement::create([
            'adv_status' => $status,
            'adv_reservation' => $reservation,
            'adv_machine_name' => $machineName,
            'adv_machine_type' => $request->adv_machine_type,
            'adv_producer' => $request->adv_producer,
            'adv_state' => $request->adv_state,
            'adv_price' => $request->adv_price,
            'adv_price_netto' => $request->adv_price_netto,
            'adv_location' => $request->adv_location,
            'adv_model' => $request->adv_model,
            'adv_year' => $request->adv_year,
            'adv_mileage' => $request->adv_mileage,
            'adv_power' => $request->adv_power,
            'adv_gear' => $request->adv_gear,
            'adv_register' => $request->adv_register,
            'adv_warranty_start' => $request->adv_warranty_start,
            'adv_warranty_end' => $request->adv_warranty_end,
            'adv_additional' => $request->adv_additional,
            'adv_serial_number' => $request->adv_serial_number,
            'adv_internal_order_number' => $request->adv_internal_order_number,
            'adv_producer_order_number' => $request->adv_producer_order_number,
            'adv_production_date' => $request->adv_production_date,
            'adv_comments' => $request->adv_comments,
            'adv_comments_additional' => $request->adv_comments_additional,
            'adv_comments_info' => $request->adv_comments_info,
            'adv_order_price' => $request->adv_order_price,
            'adv_active' => $active,
            'adv_demo' => $request->has('adv_demo') ? '1' : '0',
            'adv_promo' => $request->has('adv_promo') ? '1' : '0',
            'adv_warranty' => $request->has('adv_warranty') ? '1' : '0',
            'adv_finances' => $request->has('adv_finances') ? '1' : '0',
            'adv_position' => $position,
            'adv_magazyn_type' => '0',
            'adv_created_at' => now(),
        ]);

        return response(module_trans('Advertisements', 'success.created'), 200)
            ->header('Content-Type', 'text/plain');
    }

    public function edit($id)
    {
        $user = auth()->user();
        $advertisement = Advertisement::findOrFail($id);

        $machines = Cache::remember('crm_machines_list', now()->addHours(24), function () {
            return DB::table('crm_machines')->orderBy('position')->get();
        });
        $producers = Cache::remember('crm_producers_list', now()->addHours(24), function () {
            return DB::table('crm_producers')->orderBy('position')->get();
        });
        $locations = Cache::remember('crm_location_list', now()->addHours(24), function () {
            return DB::table('crm_location')->orderBy('position')->get();
        });
        $stans = Cache::remember('crm_stan_list', now()->addHours(24), function () {
            return DB::table('crm_stan')->orderBy('position')->get();
        });

        return view('advertisements::edit', [
            'advertisement' => $advertisement,
            'machines' => $machines,
            'producers' => $producers,
            'locations' => $locations,
            'stans' => $stans,
        ]);
    }

    public function update(UpdateAdvertisementRequest $request, $id)
    {
        $advertisement = Advertisement::findOrFail($id);

        $machines = Cache::remember('crm_machines', now()->addHours(24), function () {
            return DB::table('crm_machines')->pluck('name', 'id')->toArray();
        });
        $producers = Cache::remember('crm_producers', now()->addHours(24), function () {
            return DB::table('crm_producers')->pluck('name', 'id')->toArray();
        });

        $machineTypeName = $machines[$request->adv_machine_type] ?? '';
        $producerName = $producers[$request->adv_producer] ?? '';
        $machineName = trim($machineTypeName.' '.$producerName.' '.$request->adv_model);

        $reservation = $request->adv_reservation;
        $active = ($reservation == 2) ? '0' : '1';

        $status = match ($reservation) {
            1 => 'Rezerwacja',
            2 => 'Wkrótce',
            0 => 'Wolne',
            default => $advertisement->adv_status ?? 'Wolne',
        };

        $advertisement->update([
            'adv_status' => $status,
            'adv_reservation' => $reservation,
            'adv_machine_name' => $machineName,
            'adv_machine_type' => $request->adv_machine_type,
            'adv_producer' => $request->adv_producer,
            'adv_state' => $request->adv_state,
            'adv_price' => $request->adv_price,
            'adv_price_netto' => $request->adv_price_netto,
            'adv_location' => $request->adv_location,
            'adv_model' => $request->adv_model,
            'adv_year' => $request->adv_year,
            'adv_mileage' => $request->adv_mileage,
            'adv_power' => $request->adv_power,
            'adv_gear' => $request->adv_gear,
            'adv_register' => $request->adv_register,
            'adv_warranty_start' => $request->adv_warranty_start,
            'adv_warranty_end' => $request->adv_warranty_end,
            'adv_additional' => $request->adv_additional,
            'adv_serial_number' => $request->adv_serial_number,
            'adv_internal_order_number' => $request->adv_internal_order_number,
            'adv_producer_order_number' => $request->adv_producer_order_number,
            'adv_production_date' => $request->adv_production_date,
            'adv_comments' => $request->adv_comments,
            'adv_comments_additional' => $request->adv_comments_additional,
            'adv_comments_info' => $request->adv_comments_info,
            'adv_order_price' => $request->adv_order_price,
            'adv_active' => $active,
            'adv_demo' => $request->has('adv_demo') ? '1' : '0',
            'adv_promo' => $request->has('adv_promo') ? '1' : '0',
            'adv_warranty' => $request->has('adv_warranty') ? '1' : '0',
            'adv_finances' => $request->has('adv_finances') ? '1' : '0',
            'adv_update_at' => now(),
        ]);

        return response(module_trans('Advertisements', 'success.updated'), 200)
            ->header('Content-Type', 'text/plain');
    }

    public function destroy($id)
    {
        $user = auth()->user();

        if (! in_array($user->user_level, [1, 2, 7])) {
            abort(403);
        }

        $advertisement = Advertisement::findOrFail($id);
        $advertisement->delete();

        return response(module_trans('Advertisements', 'success.deleted'), 200)
            ->header('Content-Type', 'text/plain');
    }
}
