<?php

namespace App\Repositories;

use App\Models\Pacientes;
use App\Models\User;
use App\Interfaces\PacientesRepositoriesInterface;

class PacientesRepositories implements PacientesRepositoriesInterface {

    public function getAllUsers() {

        $pacientes = User::where('user_type', 'paciente')->get();
        return $pacientes;

    }

    public function create($request) {

        $paciente = User::create($request->all());
        return $paciente;

    }

}