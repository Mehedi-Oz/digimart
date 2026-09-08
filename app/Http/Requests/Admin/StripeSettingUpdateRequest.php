<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StripeSettingUpdateRequest extends FormRequest
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
            "stripe_publishable_key" => ['required', 'string', 'max:1000'],
            "stripe_secret_key" => ['required', 'string', 'max:1000'],
            "stripe_status" => ['required', 'in:active,inactive'],
        ];
    }
}
