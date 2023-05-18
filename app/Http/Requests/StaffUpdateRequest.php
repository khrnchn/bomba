<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffUpdateRequest extends FormRequest
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
            'user_id' => ['required', 'exists:users,id'],
            'station_id' => ['required', 'exists:stations,id'],
            'department_id' => ['required', 'exists:departments,id'],
            'referral_code' => ['required', 'max:255', 'string'],
        ];
    }
}
