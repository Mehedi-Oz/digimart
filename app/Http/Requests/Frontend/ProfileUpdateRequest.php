<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
            'avatar' => 'sometimes|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,' . $this->user()->id,
            'country' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'avatar.image' => 'The avatar must be an image file.',
            'avatar.mimes' => 'Only jpg, jpeg, png, webp, and gif formats are allowed.',
            'avatar.max'   => 'The avatar size must not exceed 2MB.',
        ];
    }
}
