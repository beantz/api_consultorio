<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidationUsersStore;
use App\Http\Services\AuthService;

class AuthController extends Controller
{
    protected $AuthService;

    public function __construct(AuthService $AuthService) {

        $this->middleware('auth:api')->except(['login', 'register']);
        $this->AuthService = $AuthService;
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        return $this->AuthService->verifyCredentials($credentials);

    }

    public function register(ValidationUsersStore $request)
    {
        $validates = $request->validated();

        return $this->AuthService->register($validates);

    }

    public function logout()
    {
        return $this->AuthService->logout();
    }

    public function refresh()
    {
        return $this->AuthService->refresh();

    }
}