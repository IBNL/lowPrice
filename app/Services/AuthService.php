<?php
declare(strict_types = 1);

namespace App\Services;

use App\Repositories\Eloquent\UserRepository;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * returns a new token for the user to authenticate
     * @param array $credentials
     * @return string $token
     */
    public function generateToken(array $credentials): string
    {
        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = $this->userRepository->getByColumn('email',$credentials['email']);
        
        $token = $user->createToken('auth_token')->plainTextToken;

        return $token;

    }
    
     /**
     * Revoke the token that was used to authenticate the current request
     * @param $request
     */
    public function deleteCurrentAccessToken($request): void
    {
        $request->user()->currentAccessToken()->delete();
    }

}