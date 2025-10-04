<?php

namespace App\Repositories;

use App\Interfaces\AgendamentoProcedimentoRepositoriesInterface;
use App\Models\Agendamento;
use Illuminate\Http\Request;
use App\Models\AgendamentoProcedimento;

class AgendamentoProcedimentoRepositorie implements AgendamentoProcedimentoRepositoriesInterface {

    public function getAll() {

        $agendamentosProcedimentos = Agendamento::with('procedimento')->get();

        return $agendamentosProcedimentos;

    }

    public function find($id_agendamento) {
        $agendamento = Agendamento::where('id', $id_agendamento)->with('procedimento')->first();
        return $agendamento;
    }

    public function create(Request $request, $id_agendamento) {

        $agendamento = Agendamento::find($id_agendamento);
        $agendamento->procedimento()->attach($request->get('id_procedimento'));
        
        return $agendamento;

    }

}