<?php

namespace App\Http\Requests\Admin;

use App\Services\NotificationService;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ItemStatusUpdateRequest extends FormRequest
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
            'status' => 'required|in:approved,rejected,soft_rejected,hard_rejected',
            'reason' => 'required_if:status,soft_rejected,hard_rejected|nullable|string|max:1000',
        ];
    }
    public function messages(): array
    {
        $status = $this->input('status');

        $reasonLabel = match ($status) {
            'soft_rejected' => 'A reason is required for a soft rejection.',
            'hard_rejected' => 'A reason is required for a hard rejection. ',
            default         => 'A reason is required when rejecting an item.',
        };

        return [
            'status.required'    => 'Please select a review status before submitting.',
            'status.in'          => 'The selected review status is not valid. Accepted values are: approved, soft rejected, or hard rejected.',
            'reason.required_if' => $reasonLabel,
            'reason.string'      => 'The rejection reason must be plain text.',
            'reason.max'         => 'The rejection reason may not exceed 1,000 characters.',
        ];
    }

    public function withValidator($validator)
    {
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                NotificationService::ERROR($error);
            }
        }
    }
}
