<?php

namespace App\Http\Requests\Post;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreatePostRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:50'],
            'category_id' => [
                'required',
                'integer',
                Rule::exists('categories', 'id')->whereNull('deleted_at'),
            ],
            'tags_ids' => ['required', 'string'],
            'description' => ['nullable'],
            'img' => ['nullable'],
            'is_hidden' => ['nullable', 'boolean'],
            'navbar' => ['nullable', 'boolean'],
        ];
    }
}
