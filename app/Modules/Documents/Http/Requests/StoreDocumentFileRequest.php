<?php

namespace Modules\Documents\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDocumentFileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $maxSize = 20 * 1024; // 20 MB in KB

        return [
            'file' => ['required', 'file', 'max:'.$maxSize],
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => module_trans('Documents', 'validation.file.required'),
            'file.file' => module_trans('Documents', 'validation.file.file'),
            'file.max' => module_trans('Documents', 'validation.file.max'),
        ];
    }
}
