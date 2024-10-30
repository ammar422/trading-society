<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiStoreCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('super_admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'instructor_id' => 'required', 'exists:instructors,id',
            'description' => 'required|string',
            'total_hours' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'photo' => ['required', 'image', 'mimes:jpeg,png,jpg'],
        ];
    }
}
