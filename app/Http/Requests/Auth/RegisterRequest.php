<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
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
        // return [
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => 'required|string|min:8',
        // ];


        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone_number' => 'required|string|max:20',
            'broker' => 'required|string|max:255',
            'broker_registration_email' => 'string|email|max:255',
            'country' => 'required|string|max:100',
            'id_number' => 'required|integer|min:1',
            'id_photo_front' => 'image|mimes:jpg,jpeg,png',
            'id_photo_back' => 'image|mimes:jpg,jpeg,png',
            'selfie_with_id' => 'image|mimes:jpg,jpeg,png',
            'profile_image' => 'required|image|mimes:jpg,jpeg,png',
            'sponsor_id' => 'required|string|max:36', 
            'is_subscribed' => 'nullable|boolean',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status' => false,
                'message' => $validator->errors(),
            ], 422)
        );
    }
}
