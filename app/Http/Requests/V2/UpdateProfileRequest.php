<?php

namespace App\Http\Requests\V2;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->guard('instructor-api')->check();
    }


    /**
     * Get the validation rules that apply to the request.
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        // Get the currently authenticated user  
        $user = auth()->guard('instructor-api')->user();

        return [
            'name'                  => 'required|string',
            'email'                 => 'required|string|email',
            'photo'                 => 'sometimes|nullable|image|mimetypes:image/*|max:2048',
            'old_password'          => [
                'required',
                'string',
                function ($attribute, $value, $fail) use ($user) {
                    // Check if the provided old password matches the current user's password  
                    if ($user && !Hash::check($value, $user->password)) {
                        $fail('The provided old password is incorrect.');
                    }
                },
            ],
            'password'              => ['sometimes', 'required', 'string', 'confirmed', Password::min(6)->numbers()],
            'password_confirmation' => 'required_with:password|same:password',
        ];
    }


    /**
     * @param Validator $validator
     * 
     * @return object
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        $response = lynx()->message(__('users::auth.validation_message'))
            ->data([
                'errors' => $errors,
                'status' => false,
            ])
            ->status(422)
            ->response();

        throw new HttpResponseException($response);
    }
}
