<?php

namespace App\Http\Requests\Tag;

use Illuminate\Foundation\Http\FormRequest;

class CreateTagRequest extends FormRequest
{
    public $validator = null;
    protected function failedValidation(
        \Illuminate\Contracts\Validation\Validator $validator
    ) {
        $this->validator = $validator;
    }
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:50'],
        ];
    }
}
