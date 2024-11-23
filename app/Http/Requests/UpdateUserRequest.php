<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'first_name' => 'sometimes|string|max:255',
            'last_name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $this->id,
            'phone_number' => 'sometimes|string|max:20',
            'broker' => 'sometimes|string|max:255',
            'broker_registration_email' => 'string|email|max:255',
            'country' => 'sometimes|string|max:100',
            'id_number' => 'sometimes|integer|min:1',
            'id_photo_front' => 'image|mimes:jpg,jpeg,png',
            'id_photo_back' => 'image|mimes:jpg,jpeg,png',
            'selfie_with_id' => 'image|mimes:jpg,jpeg,png',
            'profile_image' => 'sometimes|image|mimes:jpg,jpeg,png',
            'sponsor_id' => 'sometimes|string|max:36',
            'is_subscribed' => 'nullable|boolean',
            'status' => 'in:active,inactive'
        ];
    }
}
