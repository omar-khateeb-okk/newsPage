<?php

namespace App\Http\Requests\Category;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
{
    public $validator = null;

    protected function failedValidation(Validator $validator)
    {
        $this->validator = $validator;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:50'],
            'description' => ['nullable', 'string'],
            'file' => ['nullable', 'file', 'mimes:jpg,png,jpeg'],
            'is_active' => ['nullable', 'boolean'],
            'navbar' => ['nullable', 'boolean'],
        ];
    }
}
