<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
//    public function authorize()
//    {
//        return false;
//    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:30',
            'description' => 'required|max:250',
            'price' => 'required|integer|max:1000000|min:0',
            'units' => 'required|integer|max:1000000|min:0',
            'category_id' => 'required|integer|min:0'
        ];
    }
}
