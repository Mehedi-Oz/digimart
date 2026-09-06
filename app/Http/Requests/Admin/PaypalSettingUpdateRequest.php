<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PaypalSettingUpdateRequest extends FormRequest
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
            "paypal_mode" => ['required', 'string', 'in:sandbox,live'],
            "paypal_app_id" => ['required', 'string', 'max:255'],
            "paypal_client_id" => ['required', 'string', 'max:1000'],
            "paypal_secret_key" => ['required', 'string', 'max:1000'],
            "paypal_status" => ['required', 'in:active,inactive'],
        ];
    }
}
