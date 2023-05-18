<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckStoreRequest extends FormRequest
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
            'counter_id' => ['required', 'exists:counters,id'],
            'staff_id' => ['required', 'exists:staff,id'],
            'participant_id' => ['required', 'exists:participants,id'],
            'isCheckIn' => ['required', 'boolean'],
        ];
    }
}
