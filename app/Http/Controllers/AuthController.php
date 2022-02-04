<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * @var AuthService
     */
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $data = $request->all();
        return $this->authService->login($data);
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $data = $request->all();
        return $this->authService->register($data);
    }

    /**
     * @return JsonResponse
     */
    public function logout(Request $request)
    {
       $user = $request->user();
       return $this->authService->logout($user);
    }
}
