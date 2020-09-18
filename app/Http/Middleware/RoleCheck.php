<?php

namespace App\Http\Middleware;

use App\Repositories\UserRepository;
use Closure;

class RoleCheck
{

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * Handle an incoming request.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // TODO: terminar el middleware para los roles
        // $userCurrent = $this->userRepository->getUserWithToken($request('api_token'));
        // if ($userCurrent->authorizeRoles()) {
        //     return $next($request);
        // }
        return $this->errorResponse('Unauthorized.', 401);
    }
}
