<?php

namespace Modules\Calendar\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCalendarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:400'],
            'category' => ['required', 'string', 'max:100'],
            'start' => ['required', 'date'],
            'end' => ['required', 'date', 'after_or_equal:start'],
            'annotations' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => module_trans('Calendar', 'validation.title.required'),
            'category.required' => module_trans('Calendar', 'validation.category.required'),
            'start.required' => module_trans('Calendar', 'validation.start.required'),
            'end.required' => module_trans('Calendar', 'validation.end.required'),
            'end.after_or_equal' => module_trans('Calendar', 'validation.end.after_or_equal'),
        ];
    }
}
