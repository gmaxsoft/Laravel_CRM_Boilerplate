<?php

namespace Modules\Settings\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCalendarCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = auth()->user();

        return in_array($user->user_level, [1, 2, 7]);
    }

    public function rules(): array
    {
        return [
            'cal_cat_name' => ['required', 'string', 'max:255'],
            'cal_cat_value' => ['required', 'string', 'in:bg-primary,bg-secondary,bg-success,bg-danger,bg-warning,bg-info,bg-light,bg-dark,bg-workshop'],
        ];
    }

    public function messages(): array
    {
        return [
            'cal_cat_name.required' => module_trans('Settings', 'validation.cal_cat_name.required'),
            'cal_cat_name.string' => module_trans('Settings', 'validation.cal_cat_name.string'),
            'cal_cat_name.max' => module_trans('Settings', 'validation.cal_cat_name.max'),
            'cal_cat_value.required' => module_trans('Settings', 'validation.cal_cat_value.required'),
            'cal_cat_value.in' => module_trans('Settings', 'validation.cal_cat_value.in'),
        ];
    }
}
