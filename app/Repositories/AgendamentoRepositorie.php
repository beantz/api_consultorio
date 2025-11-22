<?php

namespace App\Repositories;

use App\Interfaces\AgendamentoRepositoriesInterface;
use App\Models\Agendamento;

class AgendamentoRepositorie {

    public function getAll() {

        $agendamentos = Agendamento::all();
        return $agendamentos;
    }

    public function create($request) {

        $agendamento = Agendamento::create($request->all());
        return $agendamento;
    }

    public function find($id_agendamento) {

        $agendamento = Agendamento::find($id_agendamento)->makeHidden('updated_at', 'created_at');
        return $agendamento;

    }

}