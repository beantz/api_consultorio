<?php

namespace App\Repositories;

use App\Models\Pacientes;
use App\Models\User;
use App\Interfaces\PacientesRepositoriesInterface;

class PacientesRepositorie {

    public function getAllUsers() {

        $pacientes = User::where('tipo_usuario', 'paciente')->get();
        return $pacientes;

    }

    public function create($request) {

        $paciente = User::create($request->all());
        return $paciente;

    }

}