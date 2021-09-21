<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|max:30',
            'briefing' => 'required|max:250',
        ];
    }
}
