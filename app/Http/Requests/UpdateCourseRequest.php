<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('instructor')->check() || auth('super_admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'nullable|string|max:255',
            'instructor_id' => 'nullable', 'exists:instructors,id',
            'description' => 'nullable|string',
            'total_hours' => 'nullable|numeric',
            'category_id' => 'nullable|exists:categories,id',
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg'],
        ];
    }
}
