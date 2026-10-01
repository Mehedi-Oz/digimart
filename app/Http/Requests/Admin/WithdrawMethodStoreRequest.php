<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class WithdrawMethodStoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'minimum_amount' => ['required', 'numeric', 'min:0'],
            'maximum_amount' => ['required', 'numeric', 'gt:minimum_amount'],
            'description' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'boolean'],
        ];
    }
}
