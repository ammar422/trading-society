<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLiveSessionRequest extends FormRequest
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
            'title'         => 'required|string',
            'description'   => 'required|string',
            'duration'      => 'required|integer',
            'image'         => 'required|image|mimes:jpeg,png,jpg,gif',
            'video'         => 'required|file|mimes:mp4,avi,mov,mkv',
            'status'        => 'required|in:active,inactive',
        ];
    }
}
