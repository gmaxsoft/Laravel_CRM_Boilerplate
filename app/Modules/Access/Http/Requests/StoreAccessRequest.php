<?php

namespace Modules\Access\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAccessRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = auth()->user();

        return $user && in_array($user->user_level, [1, 2, 7]);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'level' => ['required', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => module_trans('Access', 'validation.name.required'),
            'level.required' => module_trans('Access', 'validation.level.required'),
            'level.integer' => module_trans('Access', 'validation.level.integer'),
        ];
    }
}
