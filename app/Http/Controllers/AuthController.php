<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidationUsersStore;
use App\Facades\AuthServicesFacades;

class AuthController extends Controller
{

    public function login()
    {
        $credentials = request(['email', 'password']);

        return AuthServicesFacades::verifyCredentials($credentials);

    }

    public function register(ValidationUsersStore $request)
    {
        $validates = $request->validated();

        return AuthServicesFacades::register($validates);

    }

    public function logout()
    {
        return AuthServicesFacades::logout();
    }

    public function refresh()
    {
        return AuthServicesFacades::refresh();

    }
}