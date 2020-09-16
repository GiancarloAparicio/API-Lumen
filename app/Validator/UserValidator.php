<?php

namespace App\Validator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserValidator
{

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function validate()
    {

        return Validator::make(
            $this->request->all(),
            $this->rules(),
            $this->messages()
        );
    }

    public function rules()
    {
        return [
            'name' => ['required'],
            'email' => ['required', 'unique:users', 'email'],
            'password' => ['required', 'min:5', 'confirmed']
        ];
    }

    public function messages()
    {

        return [
            'name.required' => 'The :attribute field is required.',

            'email.required' => 'The :attribute field is required.',
            'email.unique' => 'The :attribute has already been taken.',
            'email.email' => 'The :attribute must be a valid email address.',

            'password.required' => 'The :attribute field is required.',
            'password.min' => 'The :attribute must be at least :min.',
            'password.confirmed' => 'The :attribute confirmation does not match.',
        ];
    }
}
