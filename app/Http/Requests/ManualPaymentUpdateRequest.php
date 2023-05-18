<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManualPaymentUpdateRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'file_path' => ['required', 'max:255', 'string'],
            'remarks' => ['required', 'max:255', 'string'],
            'payment_method' => ['required', 'max:255', 'string'],
        ];
    }
}
