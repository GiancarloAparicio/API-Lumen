<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use App\Repositories\UserRepository;
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
    private $userRepository;

    public function __construct(
        User $user,
        LoginValidator $loginValidator,
        UserValidator $userValidator,
        UserRepository $userRepository
    ) {
        $this->user = $user;
        $this->loginValidator = $loginValidator;
        $this->userValidator = $userValidator;
        $this->userRepository = $userRepository;
    }

    /**
     *  It function to register a user, it does not receive parameters
     *  @return Response $response
     */
    public function createUser()
    {

        $userCurrent = $this->userValidator->validate();
        $userCurrent['password'] = Hash::make($userCurrent['password']);
        $userCurrent = $this->user::create($userCurrent);
        $userCurrent->roles()->attach(Role::where('name', 'user')->first());
        return $this->successResponse('user', $userCurrent, 201);
    }

    /**
     *  Function to log in the user, it does not receive parameters
     *  @return Response $response
     */
    public function loginUser()
    {
        $validate = $this->loginValidator->validate();
        $user = $this->userRepository->getUserWithEmail($validate["email"]);

        if ($this->userCorrect($validate, $user)) {
            $user['api_token'] = $this->getToken();
            $user->save();

            return $this->successResponse('user', $user, 200)
                ->header('Token', $user['api_token']);
        }
    }

    public function logoutUser()
    {
        $user = $this->userRepository->getUserWithToken(request('api_token'));
        $user['api_token'] = null;
        $user->save();
        return $this->successResponse('Closed session: ', $user, 205);
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
    public function userCorrect($userValidate,  $user)
    {
        return isset($user) && Hash::check($userValidate['password'], $user['password']);
    }
}
