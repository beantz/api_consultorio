<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidationUsersStore;
use App\Facades\AuthServicesFacades;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        return $this->authService->verifyCredentials($credentials);

    }

    public function register(ValidationUsersStore $request)
    {
        $validates = $request->validated();

        return $this->authService->register($validates);

    }

    public function logout()
    {
        return $this->authService->logout();
    }

    public function refresh()
    {
        return $this->authService->refresh();

    }
}