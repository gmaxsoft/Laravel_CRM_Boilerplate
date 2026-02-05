<?php

namespace Modules\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = auth()->user();
        $userId = $this->route('user');

        // Admini mogą edytować wszystkich, inni tylko siebie
        if (in_array($user->user_level, [1, 2, 7])) {
            return true;
        }

        return $user->id == $userId;
    }

    public function rules(): array
    {
        $userId = $this->route('user');

        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:crm_users,email,'.$userId],
            'symbol' => ['required', 'string', 'max:2'],
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
        ];
    }
}
