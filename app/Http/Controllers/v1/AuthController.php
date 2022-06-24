<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\AuthService;


class AuthController extends Controller
{
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * returns a new token for the user to authenticate
     * @param Illuminate\Http\Request $request
     * @return json
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        $token = $this->authService->generateToken($credentials);

        return response()->json([
            'token_type' => 'Bearer',
            'access_token' => $token
        ],200);
    }

    /**
     * Revoke the token that was used to authenticate the current request
     * @param Illuminate\Http\Request $request
     * @return json
     */
    public function logout(Request $request)
    {
        $this->authService->deleteCurrentAccessToken($request);

        return response()->json([
            'message' => 'Token deleted'
        ],200);
    }
}
