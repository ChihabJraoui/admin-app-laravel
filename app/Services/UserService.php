<?php

namespace App\Services;

use App\Models\Investment;
use App\Repositories\AccountRepository;
use App\Repositories\UserRepository;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserService
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    /**
     * Get many users
     *
     * @return JsonResponse
     */
    function getManyUsers()
    {
        return $this->userRepository->getManyUsers();
    }

    /**
     * Get many users
     *
     * @return JsonResponse
     */
    function getLastJoinedUsers()
    {
        return $this->userRepository->getLastJoinedUsers();
    }

    /**
     * Get one user details
     * with accounts
     *
     * @param $request
     * @param $id
     * @return JsonResponse
     */
    function getOneUser($request, $id)
    {
        return $this->userRepository->getOneUserWithDetails($request, $id);
    }
}
