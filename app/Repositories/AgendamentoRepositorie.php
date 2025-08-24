<?php

namespace App\Repositories;

use App\Interfaces\AgendamentoRepositoriesInterface;
use App\Models\Agendamento;

class AgendamentoRepositorie implements AgendamentoRepositoriesInterface {

    public function getAll() {

        $agendamentos = Agendamento::all();
        return $agendamentos;
    }

    public function create($request) {

        $agendamento = Agendamento::create($request->all());
        return $agendamento;
    }

}