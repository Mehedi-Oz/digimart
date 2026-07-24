<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class KycSettingUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nid_verification' => ['nullable', 'boolean'],
            'passport_verification' => ['nullable', 'boolean'],
            'instructions' => ['nullable', 'string', 'max:2000'],
            'auto_approve' => ['nullable', 'boolean'],
            'status' => ['required', 'boolean'],
        ];
    }
}
