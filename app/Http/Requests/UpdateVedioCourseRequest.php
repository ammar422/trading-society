<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVedioCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('instructor')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'course_id' => 'sometimes|exists:courses,id',
            'vedio_url' => 'sometimes|file|mimes:mp4,avi,mov,mkv',
            'duration' => 'sometimes|numeric',
            'description' => 'sometimes|string|max:1000',
            'order' => 'sometimes|numeric|max:1000',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif',
        ];
    }
}
