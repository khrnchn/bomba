<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'string'],
            'email' => [
                'required',
                Rule::unique('users', 'email')->ignore($this->user),
                'email',
            ],
            'password' => ['nullable'],
            'ic_no' => ['required', 'max:255', 'string'],
            'dob' => ['required', 'max:255', 'string'],
            'gender_id' => ['required', 'exists:references,id'],
            'age' => ['required', 'max:255'],
            'phone_no' => ['required', 'max:255', 'string'],
            'world_city_id' => ['required', 'max:255'],
            'world_division_id' => ['required', 'max:255'],
            'roles' => 'array',
        ];
    }
}
