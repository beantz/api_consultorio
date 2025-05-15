<?php

namespace App\Http\Repositories;

use App\Models\Pacientes;
use App\Models\User;

class PacientesRepositories {

    public function getAllUsers() {

        $pacientes = User::where('user_type', 'paciente')->get();
        return $pacientes;

    }

    public function create($request) {

        $paciente = User::create($request->all());
        return $paciente;

    }

}