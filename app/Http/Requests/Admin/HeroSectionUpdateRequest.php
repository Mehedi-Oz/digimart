<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class HeroSectionUpdateRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'sub_title' => ['required', 'string', 'max:1000'],
            'featured_items_one' => ['nullable', 'array'],
            'featured_items_one.*' => ['integer', 'exists:items,id'],
            'featured_items_two' => ['nullable', 'array'],
            'featured_items_two.*' => ['integer', 'exists:items,id'],
        ];
    }
}
