<?php

namespace App\Services;

use App\Models\User;

use App\Validator\LoginValidator;
use App\Validator\UserValidator;
use Illuminate\Support\Facades\Hash;

use App\Traits\Response;

class UserServices
{

    use Response;

    private $user;
    private $loginValidator;
    private $userValidator;

    public function __construct(
        User $user,
        LoginValidator $loginValidator,
        UserValidator $userValidator
    ) {
        $this->user = $user;
        $this->loginValidator = $loginValidator;
        $this->userValidator = $userValidator;
    }

    /**
     *  It function to register a user, it does not receive parameters
     *  @return Response $response
     */
    public function createUser()
    {
        $user = $this->userValidator->validate();
        $user['password'] = Hash::make($user['password']);
        $user = $this->user::create($user);

        return $this->successResponse('user', $user, 201);
    }

    /**
     *  Function to log in the user, it does not receive parameters
     *  @return Response $response
     */
    public function loginUser()
    {
        $userValidate = $this->loginValidator->validate();
        $user = $this->user::where('email', $userValidate["email"])->first();

        if ($this->userCorrect($user, $userValidate)) {
            $user['api_token'] = $this->getToken();
            $user->save();

            return $this->successResponse('user', $user, 200)->header('Token', $user['api_token']);
        }

        return $this->errorResponse('Authentication Error', 401);
    }

    /**
     * Get a random token
     */
    public function getToken()
    {
        return bin2hex(random_bytes(20));
    }

    /**
     *  Check if the user exists and if the password matches the account hash
     */
    public function userCorrect($user,  $userValidate)
    {
        return isset($user) && Hash::check($userValidate['password'], $user['password']);
    }
}
