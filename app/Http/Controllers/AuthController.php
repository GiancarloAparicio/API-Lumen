<?php

namespace App\Http\Controllers;

use App\Services\UserServices;

class AuthController extends Controller
{

    /**
     * Login user , parameters are received by dependency injection
     * 
     * @param  Object $userService
     * @return \Illuminate\Http\Response
     */
    public function login(UserServices $userService)
    {
        return $userService->loginUser();
    }

    /**
     * Register User, parameters are received by dependency injection
     *
     * @param  Object $userService
     * @return \Illuminate\Http\Response
     */
    public function register(UserServices $userService)
    {
        return $userService->createUser();
    }

    /**
     * Register User, parameters are received by dependency injection
     *
     * @param  Object $userService
     * @return \Illuminate\Http\Response
     */
    public function logout(UserServices $userService)
    {
        return $userService->logoutUser();
    }
}
