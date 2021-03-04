<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponse;

    /**
     * Login
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    // TODO: needs optimizations
    function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
//            'remember_me' => 'boolean'
        ]);

        $credentials = $request->only('email', 'password');

        $admin = Admin::where('email', $credentials['email'])->first();

        if(!isset($admin))
        {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        if(!Hash::check($credentials['password'], $admin->password))
        {
            return response()->json([
                'message' => 'Incorrect Credentials'
            ], 400);
        }

        $tokenResult = $admin->createToken('Personal Access Token');

        $token = $tokenResult->token;

        if ($request->remember_me)
        {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }

        $token->save();

        $admin->access_token = $tokenResult->accessToken;
        $admin->token_type = 'Bearer';
        $admin->expires_at = Carbon::parse(
            $tokenResult->token->expires_at
        )->toDateTimeString();

        return $this->success($admin);
    }

    function refreshToken(Request $request)
    {

    }
}
