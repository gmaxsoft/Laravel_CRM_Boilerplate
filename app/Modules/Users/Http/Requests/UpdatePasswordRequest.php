<?php

namespace Modules\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = auth()->user();
        $userId = $this->route('user');

        // Admini mogą zmieniać hasła wszystkich, inni tylko swoje
        if (in_array($user->user_level, [1, 2, 7])) {
            return true;
        }

        return $user->id == $userId;
    }

    public function rules(): array
    {
        return [
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'password.required' => module_trans('Users', 'validation.password.required'),
            'password.min' => module_trans('Users', 'validation.password.min'),
            'password.confirmed' => module_trans('Users', 'validation.password_confirmation.confirmed'),
        ];
    }
}
