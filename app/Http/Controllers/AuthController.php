<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService)
    {
        $this->middleware('jwt')->only('info', 'logout');
    }

    /**
     * Registration
     * Create a unique user
     *
     * @return JsonResponse
     */
    public function register(RegistrationRequest $request)
    {
        $authResponse = $this->authService->register($request->all());

        return response()->json(['user' => $authResponse, 'message' => 'User created'], 201);
    }

    /**
     * Login
     * Authenticate a user
     *
     * @return JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $authResponse = $this->authService->login($request->validated());

        return response()->json($authResponse, 200);
    }

    /**
     * Profile
     * Profile information of currently logged in user
     *
     * @return JsonResponse
     */
    public function info()
    {
        return auth()->user();
    }

    /**
     * Comments
     * Lists of comments in chronological order
     *
     * @return JsonResponse|null
     */
    public function logout(): mixed
    {
        $this->authService->logout();

        return response()->noContent();
    }
}
