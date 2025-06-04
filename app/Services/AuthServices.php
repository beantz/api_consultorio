<?php

namespace App\Services;

use App\Models\User;
use App\Traits\ApiResponse;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthServices {

    use ApiResponse;

    public function verifyCredentials($credentials) {

        try {
            if (!$token = JWTAuth::attempt($credentials)) { 
                    return response()->json(['error' => 'Credenciais inválidas'], 401);
                }
            } catch (JWTException $e) {
                return response()->json(['error' => 'Não foi possível criar o token'], 500);
            }

        return $this->respondWithToken($token);

    }

    public function register($validates) {

        $user = User::create($validates);

        $token = JWTAuth::fromUser($user);

        return $this->respondWithToken($token);

    }

    public function logout() {

        JWTAuth::invalidate(JWTAuth::getToken());
        
        return response()->json(['message' => 'Logout realizado com sucesso']);

    }

    public function refresh() {
        
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