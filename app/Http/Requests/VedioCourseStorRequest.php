<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VedioCourseStorRequest extends FormRequest
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
            'course_id' => 'required|exists:courses,id', // Ensure course_id exists in the courses table  
            'vedio_url' => 'required|file|mimes:mp4,avi,mov,mkv|max:10240',
            'duration' => 'required|date_format:H:i', // Validate time format (24-hour format)  
            'description' => 'required|string|max:1000', // Validate description length  
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file  
        ];
    }
}
