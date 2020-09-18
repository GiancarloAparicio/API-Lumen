<?php

namespace App\Validator;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class TaskValidator
{

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function validate()
    {

        $validator = Validator::make(
            $this->request->all(),
            $this->rules(),
            $this->messages()
        );

        if ($validator->fails()) {
            throw new ValidationException(
                $validator,
                new JsonResponse($validator->errors()->getMessages(), 422)
            );
        }

        return $validator->validateWithBag('post');
    }

    public function rules()
    {
        return [
            'title' => ['required'],
            'name' => ['required'],
            'description' => ['required']
        ];
    }

    public function messages()
    {

        return [
            'title.required' => 'The :attribute field is required.',
            'name.required' => 'The :attribute field is required.',
            'description.required' => 'The :attribute field is required.',
        ];
    }
}
