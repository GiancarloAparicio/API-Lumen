<?php

namespace App\Validator;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserValidator
{

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     *  Validate the Request and only return the validated fields, otherwise it throws an exception
     *  @return Object $user
     */
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
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email' . $this->request->id],
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
