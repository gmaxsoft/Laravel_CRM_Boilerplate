<?php

namespace Modules\Customers\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Modules\Customers\Http\Requests\StoreCustomerRequest;
use Modules\Customers\Http\Requests\UpdateCustomerRequest;
use Modules\Customers\Models\Customer;
use Modules\Users\Models\User;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        $canAdd = true;
        $canDelete = in_array($user->user_level, [1, 2]);
        $traders = Cache::remember('users_traders', now()->addMinutes(30), function () {
            return User::whereIn('user_level', [1, 5, 6, 7])->orderBy('first_name')->get();
        });

        return view('customers::index', [
            'canAdd' => $canAdd,
            'canDelete' => $canDelete,
            'traders' => $traders,
        ]);
    }

    public function grid()
    {
        $user = auth()->user();
        $level = $user->user_level;
        $userId = $user->id;

        if (in_array($level, [1, 2, 3, 4, 5, 7])) {
            $customers = Customer::where('customers_type', '0')
                ->where('customers_active', '0')
                ->with('trader')
                ->orderBy('customers_adddate', 'desc')
                ->get();
        } else {
            $customers = Customer::where('customers_type', '0')
                ->where('customers_active', '0')
                ->where('customers_trader_id', $userId)
                ->with('trader')
                ->orderBy('customers_adddate', 'desc')
                ->get();
        }

        $lp = 0;
        $json = [];

        foreach ($customers as $row) {
            $lp++;
            $traderName = $row->trader ? $row->trader->first_name.' '.$row->trader->last_name : '';

            $action = '<a class="btn btn-primary" href="/module/customers/edit/'.$row->customers_id.'"><i class="fas fa-pen"></i></a>';

            if (in_array($level, [1, 2])) {
                $action .= '&nbsp;<a class="btn btn-danger delete-button" data-id="'.$row->customers_id.'" href="#"><i class="fas fa-trash-alt"></i></a>';
            }

            $json[] = [
                'state' => '<input data-index="'.$row->customers_id.'" name="btSelectItem" class="checkedbox" type="checkbox">',
                'action' => $action,
                'lp' => $lp,
                'customers_id' => $row->customers_id,
                'customers_code' => $row->customers_code ?? '',
                'customers_firmname' => $row->customers_firmname ?? '',
                'customers_firstname' => $row->customers_firstname ?? '',
                'customers_lastname' => $row->customers_lastname ?? '',
                'customers_nip' => $row->customers_nip ?? '',
                'customers_email' => $row->customers_email ?? '',
                'customers_phone' => $row->customers_phone ?? '',
                'customers_area' => $row->customers_area ?? '',
                'customers_postcode' => $row->customers_postcode ?? '',
                'customers_county' => $row->customers_county ?? '',
                'customers_trader_id' => $traderName,
                'customers_rodo' => $row->customers_rodo ?? '',
                'customers_re_contact_date' => $row->customers_re_contact_date ?? '',
                'customers_agricultural_land' => $row->customers_agricultural_land ?? '',
                'customers_legalform' => $row->customers_legalform ?? '',
            ];
        }

        return response()->json($json);
    }

    public function create()
    {
        $user = auth()->user();
        $traders = Cache::remember('users_traders', now()->addMinutes(30), function () {
            return User::whereIn('user_level', [1, 5, 6, 7])->orderBy('first_name')->get();
        });

        return view('customers::create', [
            'traders' => $traders,
        ]);
    }

    public function store(StoreCustomerRequest $request)
    {
        Customer::create([
            'customers_firmname' => $request->customers_firmname,
            'customers_firstname' => $request->customers_firstname,
            'customers_lastname' => $request->customers_lastname,
            'customers_phone' => $request->customers_phone,
            'customers_email' => $request->customers_email,
            'customers_rodo' => $request->customers_rodo,
            'customers_adres' => $request->customers_adres,
            'customers_city' => $request->customers_city,
            'customers_postcode' => $request->customers_postcode,
            'customers_area' => $request->customers_area,
            'customers_county' => $request->customers_county,
            'customers_community' => $request->customers_community,
            'customers_postoffice' => $request->customers_postoffice,
            'customers_country' => $request->customers_country ?? 'Polska',
            'customers_legalform' => $request->customers_legalform,
            'customers_regon' => $request->customers_regon,
            'customers_nip' => $request->customers_nip,
            'customers_krs' => $request->customers_krs,
            'customers_trader_id' => $request->customers_trader_id,
            'customers_agricultural_land' => $request->customers_agricultural_land,
            'customers_aditional' => $request->customers_aditional,
            'customers_type' => '0',
            'customers_active' => '0',
            'customers_re_contact_date' => $request->customers_re_contact_date,
            'customers_re_contact_date_cron' => 0,
            'customers_sp_email' => $request->has('customers_sp_email') ? 1 : 0,
            'customers_sp_sms' => $request->has('customers_sp_sms') ? 1 : 0,
            'customers_sp_phone' => $request->has('customers_sp_phone') ? 1 : 0,
            'customers_sp_postoffice' => $request->has('customers_sp_postoffice') ? 1 : 0,
            'customers_adddate' => now(),
        ]);

        return response(module_trans('Customers', 'success.created'), 200)
            ->header('Content-Type', 'text/plain');
    }

    public function edit($id)
    {
        $user = auth()->user();
        $customer = Customer::findOrFail($id);
        $traders = Cache::remember('users_traders', now()->addMinutes(30), function () {
            return User::whereIn('user_level', [1, 5, 6, 7])->orderBy('first_name')->get();
        });

        return view('customers::edit', [
            'customer' => $customer,
            'traders' => $traders,
        ]);
    }

    public function update(UpdateCustomerRequest $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $customer->update([
            'customers_firmname' => $request->customers_firmname,
            'customers_firstname' => $request->customers_firstname,
            'customers_lastname' => $request->customers_lastname,
            'customers_phone' => $request->customers_phone,
            'customers_email' => $request->customers_email,
            'customers_rodo' => $request->customers_rodo,
            'customers_adres' => $request->customers_adres,
            'customers_city' => $request->customers_city,
            'customers_postcode' => $request->customers_postcode,
            'customers_area' => $request->customers_area,
            'customers_county' => $request->customers_county,
            'customers_community' => $request->customers_community,
            'customers_postoffice' => $request->customers_postoffice,
            'customers_country' => $request->customers_country ?? 'Polska',
            'customers_legalform' => $request->customers_legalform,
            'customers_regon' => $request->customers_regon,
            'customers_nip' => $request->customers_nip,
            'customers_krs' => $request->customers_krs,
            'customers_trader_id' => $request->customers_trader_id,
            'customers_agricultural_land' => $request->customers_agricultural_land,
            'customers_aditional' => $request->customers_aditional,
            'customers_re_contact_date' => $request->customers_re_contact_date,
            'customers_re_contact_date_cron' => 0,
            'customers_sp_email' => $request->has('customers_sp_email') ? 1 : 0,
            'customers_sp_sms' => $request->has('customers_sp_sms') ? 1 : 0,
            'customers_sp_phone' => $request->has('customers_sp_phone') ? 1 : 0,
            'customers_sp_postoffice' => $request->has('customers_sp_postoffice') ? 1 : 0,
            'customers_update' => now(),
        ]);

        return response(module_trans('Customers', 'success.updated'), 200)
            ->header('Content-Type', 'text/plain');
    }

    public function destroy($id)
    {
        $user = auth()->user();

        if (! in_array($user->user_level, [1, 2])) {
            abort(403);
        }

        $customer = Customer::findOrFail($id);
        $customer->delete();

        return response(module_trans('Customers', 'success.deleted'), 200)
            ->header('Content-Type', 'text/plain');
    }
}
