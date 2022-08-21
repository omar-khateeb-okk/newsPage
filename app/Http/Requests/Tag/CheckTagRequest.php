<?php

namespace App\Http\Requests\Tag;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CheckTagRequest extends FormRequest
{
    public function validationData()
    {
        return array_merge($this->all(), $this->route()->parameters());
    }
    public $validator = null;
    protected function failedValidation(
        \Illuminate\Contracts\Validation\Validator $validator
    ) {
        $this->validator = $validator;
    }
    public function rules()
    {
        return [
            'tag_id' => [
                'required',
                'integer',
                Rule::exists('tags', 'id')->whereNull('deleted_at'),
            ],
        ];
    }
}
