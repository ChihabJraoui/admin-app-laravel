<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    private $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    /**
     * Get Many Users
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getManyUsers()
    {
        return $this->success($this->userService->getManyUsers());
    }

    /**
     * Get Many Users
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLastJoinedUsers()
    {
        return $this->success($this->userService->getLastJoinedUsers());
    }

    /**
     * Get One User by ID
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOneUser(Request $request, $id)
    {
        return $this->success($this->userService->getOneUser($request, $id));
    }
}
