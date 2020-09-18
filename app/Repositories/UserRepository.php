<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;

class UserRepository
{

    private $user;

    public function __construct(User $user)
    {

        $this->user = $user;
    }

    /**
     * Returns the user with the corresponding email, otherwise it throws an exception
     * @param String $email
     * @return App\Models\User 
     */
    public function getUserWithEmail(String $email)
    {
        $user = $this->user::where('email', $email)->first();

        if (!isset($user)) {
            throw new AuthenticationException();
        }
        return $user;
    }

    /**
     * Returns the user with the corresponding Token, otherwise it throws an exception
     * @param String $token
     * @return App\Models\User 
     */
    public function getUserWithToken(String $token)
    {
        $user = $this->user::where('api_token', $token)->first();

        if (!isset($user)) {
            throw new AuthenticationException();
        }
        return $user;
    }
}
