<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeedbackUpdateRequest extends FormRequest
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
            'participant_id' => ['required', 'exists:participants,id'],
            'comment' => ['required', 'max:255', 'string'],
            'rating' => ['required', 'max:255', 'string'],
            'feedback_photo_path' => ['required', 'max:255', 'string'],
        ];
    }
}
