<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTradeRequest extends FormRequest
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
            'instructor_id' => 'sometimes|exists:instructors,id',
            'order_status' => 'sometimes|string',
            'pair' => 'sometimes|string',
            'price' => 'sometimes|numeric|min:0.01',
            'order_type' => 'sometimes|string',
            'sl' => 'nullable|numeric',
            'tp1' => 'nullable|numeric',
            'tp2' => 'nullable|numeric',
            'tp3' => 'nullable|numeric',
            'tp4' => 'nullable|numeric',
            'tp5' => 'nullable|numeric',
            'chart' => 'image|mimes:jpeg,png,jpg,gif',
            'description' => 'nullable|string|max:255',
        ];
    }
}
