<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|max:30',
            'description' => 'required|max:250',
            'price' => 'required|integer|max:1000000|min:0',
            'units' => 'required|integer|max:1000000|min:0',
            'category' => 'required|integer|min:0'
        ];
    }
}
