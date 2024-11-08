<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminOfferRequest extends FormRequest
{
    public function authorize()
    {

        return true;
    }

    public function rules()
    {
        return [
            'instructor_id' => 'required|exists:instructors,id',
            'order_status' => 'required|string|max:255',
            'pair' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'order_type' => 'required|string|in:buy,sell',
            'sl' => 'nullable|numeric|min:0',
            'tp1' => 'nullable|numeric|min:0',
            'tp2' => 'nullable|numeric|min:0',
            'tp3' => 'nullable|numeric|min:0',
            'tp4' => 'nullable|numeric|min:0',
            'tp5' => 'nullable|numeric|min:0',
            'chart' => 'nullable|url|max:255',
            'description' => 'nullable|string|max:1000',
        ];
    }
}
