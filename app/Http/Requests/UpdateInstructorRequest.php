<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInstructorRequest extends FormRequest
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
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:instructors,email,' . $this->id,
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'position' => 'string|max:100',
            'description' => 'nullable|string|max:500',
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
            'video' => ['nullable', 'mimes:mp4,mov,ogg,qt']

        ];
    }
}
