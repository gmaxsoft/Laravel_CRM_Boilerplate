<?php

namespace Modules\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = auth()->user();

        return $user && in_array($user->user_level, [1, 2, 7]);
    }

    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:crm_users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'symbol' => ['required', 'string', 'max:2'],
            'user_level' => ['required', 'integer'],
            'stand_name' => ['nullable', 'string', 'max:300'],
            'phone' => ['nullable', 'string', 'max:80'],
            'department' => ['nullable', 'string', 'max:300'],
            'description' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => module_trans('Users', 'validation.first_name.required'),
            'last_name.required' => module_trans('Users', 'validation.last_name.required'),
            'email.required' => module_trans('Users', 'validation.email.required'),
            'email.email' => module_trans('Users', 'validation.email.email'),
            'email.unique' => module_trans('Users', 'validation.email.unique'),
            'password.required' => module_trans('Users', 'validation.password.required'),
            'password.min' => module_trans('Users', 'validation.password.min'),
            'password.confirmed' => module_trans('Users', 'validation.password_confirmation.confirmed'),
            'symbol.required' => module_trans('Users', 'validation.symbol.required'),
            'user_level.required' => module_trans('Users', 'validation.user_level.required'),
        ];
    }
}
