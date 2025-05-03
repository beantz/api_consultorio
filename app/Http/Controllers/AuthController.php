<?php

namespace App\Http\Controllers;

use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Controller;
use App\Http\Requests\ValidationUsersStore;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api')->except(['login', 'register']);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        try {
            if (!$token = JWTAuth::attempt($credentials)) { 
                return response()->json(['error' => 'Credenciais inválidas'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Não foi possível criar o token'], 500);
        }

        return $this->respondWithToken($token);
    }

    public function register(ValidationUsersStore $request)
    {
        $request->validated();

        $user = User::create($request->all());

        $token = JWTAuth::fromUser($user);

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        
        return response()->json(['message' => 'Logout realizado com sucesso']);
    }

    public function refresh()
    {
        try {
            $newToken = JWTAuth::refresh(JWTAuth::getToken());
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token não pode ser atualizado'], 401);
        }

        return $this->respondWithToken($newToken);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60
        ]);
    }
}