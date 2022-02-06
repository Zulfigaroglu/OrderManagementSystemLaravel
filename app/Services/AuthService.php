<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function register(array $data): JsonResponse
    {
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        $user->save();

        return response()->json($user, 201);
    }

    public function login(array $data): JsonResponse
    {
        $credentials = Arr::only($data, ['email', 'password']);
        if (!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);

        /**
         * @var User $user
         */
        $user = Auth::user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();

        return response()->json([
            'user' => $user,
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
        ]);
    }

    public function logout($user): JsonResponse
    {
        $user->token()->revoke();
        return response()->json(['message' => 'Successfully logged out']);
    }
}
