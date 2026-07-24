<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class KycVerificationStoreRequest extends FormRequest
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
            'document_type' => ['required', 'string', 'in:nid,passport'],
            'document_number' => ['required', 'string', 'max:100'],
            'documents' => ['required'],
            'documents.*' => ['file', 'mimetypes:image/jpeg,image/png,image/webp,application/pdf', 'max:5000']
        ];
    }

    public function messages(): array
    {
        return [
            'document_type.required' => __('Please select a document type.'),
            'document_type.in'       => __('Invalid document type selected.'),
            'document_number.required' => __('Document number is required.'),
            'document_number.max'    => __('Document number must not exceed 100 characters.'),
            'documents.required'     => __('Please attach at least one document.'),
            'documents.*.file'       => __('Each document must be a valid file.'),
            'documents.*.mimetypes'  => __('Accepted formats: JPG, PNG, WebP, PDF.'),
            'documents.*.max'        => __('Each file must not exceed 5MB.'),
        ];
    }
}
