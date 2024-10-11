<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTradeRequest extends FormRequest
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
            'instructor_id' => 'required|exists:instructors,id',  // Assuming there is an instructors table  
            'order_status' => 'required|string', // Example statuses  
            'pair' => 'required|string',  // Adjust max length and/or add regex for valid pairs  
            'price' => 'required|numeric|min:0.01', // Minimum price of 0.01  
            'order_type' => 'required|string', // Example order types  
            'sl' => 'nullable|numeric', // Stop loss, optional  
            'tp1' => 'nullable|numeric',
            'tp2' => 'nullable|numeric',
            'tp3' => 'nullable|numeric',
            'tp4' => 'nullable|numeric',
            'tp5' => 'nullable|numeric',
            'chart' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string|max:255', // Optional description  
        ];
    }
}
