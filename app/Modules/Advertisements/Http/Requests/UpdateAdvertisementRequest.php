<?php

namespace Modules\Advertisements\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdvertisementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'adv_machine_type' => ['required', 'integer'],
            'adv_producer' => ['required', 'integer'],
            'adv_model' => ['required', 'string', 'max:300'],
            'adv_year' => ['required', 'string', 'max:30'],
            'adv_location' => ['required', 'string', 'max:300'],
            'adv_reservation' => ['required', 'integer'],
            'adv_state' => ['nullable', 'string', 'max:100'],
            'adv_price' => ['nullable', 'string', 'max:100'],
            'adv_price_netto' => ['nullable', 'string', 'max:100'],
            'adv_mileage' => ['nullable', 'string', 'max:100'],
            'adv_power' => ['nullable', 'string', 'max:100'],
            'adv_gear' => ['nullable', 'string', 'max:200'],
            'adv_register' => ['nullable', 'string', 'max:100'],
            'adv_warranty_start' => ['nullable', 'date'],
            'adv_warranty_end' => ['nullable', 'date'],
            'adv_additional' => ['nullable', 'string'],
            'adv_serial_number' => ['nullable', 'string', 'max:100'],
            'adv_internal_order_number' => ['nullable', 'string', 'max:100'],
            'adv_producer_order_number' => ['nullable', 'string', 'max:100'],
            'adv_production_date' => ['nullable', 'date'],
            'adv_comments' => ['nullable', 'string'],
            'adv_comments_additional' => ['nullable', 'string'],
            'adv_comments_info' => ['nullable', 'string'],
            'adv_order_price' => ['nullable', 'string', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'adv_machine_type.required' => module_trans('Advertisements', 'validation.adv_machine_type.required'),
            'adv_producer.required' => module_trans('Advertisements', 'validation.adv_producer.required'),
            'adv_model.required' => module_trans('Advertisements', 'validation.adv_model.required'),
            'adv_year.required' => module_trans('Advertisements', 'validation.adv_year.required'),
            'adv_location.required' => module_trans('Advertisements', 'validation.adv_location.required'),
            'adv_reservation.required' => module_trans('Advertisements', 'validation.adv_reservation.required'),
        ];
    }
}
