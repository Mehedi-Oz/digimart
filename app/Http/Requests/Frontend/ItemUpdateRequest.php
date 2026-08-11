<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ItemUpdateRequest extends FormRequest
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
            'description' => ['required', 'string'],
            'version' => ['nullable', 'string', 'max:255'],
            'demo_link' => ['nullable', 'url', 'regex:/^(https?:\/\/)?[\w\-]+(\.[\w\-]+)+[\/#?]?.*$/'],
            'tags' => ['required', 'string', 'max:255'],
            'preview_type' => ['nullable', 'in:image,video,audio'],
            'preview_file' => ['nullable', 'string', 'max:255'],
            'source_type' => ['nullable', 'in:upload,link'],
            'upload_source' => ['nullable', 'string', 'max:500'],
            'link_source' => ['nullable', 'url', 'regex:/^(https?:\/\/)?[\w\-]+(\.[\w\-]+)+[\/#?]?.*$/', 'max:500'],
            'screenshots' => ['nullable', 'array'],
            'support' => ['nullable', 'in:0,1'],
            'support_instruction' => ['nullable'],
            'price' => ['required', 'numeric', 'min:1'],
            'discount_price' => ['nullable', 'numeric', 'min:1', 'lt:price'],
            'is_free' => ['required', 'in:0,1'],
            'message_for_review' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'discount_price.lt' => __('Discount price must be less than the regular price.'),
        ];
    }
}
