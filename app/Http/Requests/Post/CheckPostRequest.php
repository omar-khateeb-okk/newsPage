<?php

namespace App\Http\Requests\Post;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CheckPostRequest extends FormRequest
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
            'post_id' => [
                'required',
                'integer',
                Rule::exists('posts', 'id')->whereNull('deleted_at'),
            ],
        ];
    }
}
