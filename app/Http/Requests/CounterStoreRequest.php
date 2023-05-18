<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CounterStoreRequest extends FormRequest
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
            'program_id' => ['required', 'exists:programs,id'],
            'name' => ['required', 'max:255', 'string'],
            'isCheckIn' => ['required', 'boolean'],
        ];
    }
}
