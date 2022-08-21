<?php

namespace App\Http\Requests\Category;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    public $validator = null;

    protected function failedValidation(Validator $validator)
    {
        $this->validator = $validator;
    }

    public function validationData()
    {
        return array_merge($this->all(), $this->route()->parameters());
    }

    public function rules()
    {
        return [
            'category_id' => [
                'required',
                'integer',
                Rule::exists('categories', 'id')->whereNull('deleted_at'),
            ],
            'name' => ['required', 'string', 'max:50'],
            'description' => ['nullable', 'string'],
            'img' => ['nullable','mimes:jpg,png,jpeg'],
            'is_active' => ['nullable', 'integer'],
            'navbar' => ['nullable', 'integer'],
        ];
    }
}
