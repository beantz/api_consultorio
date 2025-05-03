<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidationUsers;
use App\Http\Requests\ValidationUsersStore;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

//adaptar respostas para retornar um apiResponse
class UserController extends Controller
{

    use ApiResponse;

    public function store(ValidationUsersStore $request) {

        $request->validated();

        $user = User::create($request->all());

        //gerando token para user recém criado
        $token = JWTAuth::fromUser($user);

        return $this->success($user, 'Usuário cadastrado com sucesso!', $token ,201);

    }
}
