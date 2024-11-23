<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOfferRequest extends FormRequest
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
            'instructor_id' => 'required|exists:instructors,id',
            'order_status' => 'required|string',
            'pair' => 'required|string',
            'price' => 'required|numeric|min:0.01',
            'order_type' => 'required|string',
            'sl' => 'nullable|numeric',
            'tp1' => 'nullable|numeric',
            'tp2' => 'nullable|numeric',
            'tp3' => 'nullable|numeric',
            'tp4' => 'nullable|numeric',
            'tp5' => 'nullable|numeric',
            'chart' => 'sometimes|image|mimes:jpeg,png,jpg,gif',
            'description' => 'nullable|string|max:255',
        ];
    }
}
