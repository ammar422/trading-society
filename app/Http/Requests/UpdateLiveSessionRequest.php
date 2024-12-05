<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLiveSessionRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'         => 'sometimes|nullable|string',
            'description'   => 'sometimes|nullable|string',
            'duration'      => 'sometimes|nullable|integer',
            'image'         => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif',
            'video'         => 'sometimes|nullable|file|mimes:mp4,avi,mov,mkv',
            'status'        => 'sometimes|nullable|in:active,inactive',
        ];
    }
}
