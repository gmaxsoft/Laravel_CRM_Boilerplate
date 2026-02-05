<?php

namespace Modules\Customers\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'customers_firstname' => ['required', 'string', 'max:150'],
            'customers_lastname' => ['required', 'string', 'max:150'],
            'customers_phone' => ['required', 'string', 'max:25'],
            'customers_email' => ['nullable', 'email', 'max:80'],
            'customers_adres' => ['required', 'string', 'max:300'],
            'customers_firmname' => ['nullable', 'string', 'max:300'],
            'customers_city' => ['nullable', 'string', 'max:150'],
            'customers_postcode' => ['nullable', 'string', 'max:50'],
            'customers_area' => ['nullable', 'string', 'max:80'],
            'customers_county' => ['nullable', 'string', 'max:120'],
            'customers_community' => ['nullable', 'string', 'max:200'],
            'customers_postoffice' => ['nullable', 'string', 'max:200'],
            'customers_country' => ['nullable', 'string', 'max:100'],
            'customers_regon' => ['nullable', 'string', 'max:25'],
            'customers_nip' => ['nullable', 'string', 'max:25'],
            'customers_krs' => ['nullable', 'string', 'max:80'],
            'customers_legalform' => ['nullable', 'string', 'max:180'],
            'customers_agricultural_land' => ['nullable', 'string', 'max:150'],
            'customers_rodo' => ['nullable', 'string', 'max:25'],
            'customers_aditional' => ['nullable', 'string'],
            'customers_trader_id' => ['nullable', 'integer', 'exists:crm_users,id'],
            'customers_re_contact_date' => ['nullable', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'customers_firstname.required' => module_trans('Customers', 'validation.customers_firstname.required'),
            'customers_lastname.required' => module_trans('Customers', 'validation.customers_lastname.required'),
            'customers_phone.required' => module_trans('Customers', 'validation.customers_phone.required'),
            'customers_adres.required' => module_trans('Customers', 'validation.customers_adres.required'),
            'customers_email.email' => module_trans('Customers', 'validation.customers_email.email'),
        ];
    }
}
