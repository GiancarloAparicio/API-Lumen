<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Validator\UserValidator;

class AuthController extends Controller
{

    /**
     * @param  App\Validator\UserValidator  $validator
     * @param  \Illuminate\Http\Request  $request
     */
    public function __construct(UserValidator $validator, Request $request)
    {
        $this->validator = $validator;
        $this->request = $request;
    }

    /**
     * Login user
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return $this->request;
    }

    /**
     * Register User
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return $this->request;
    }
}
