<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface AgendamentoProcedimentoRepositoriesInterface {
    
    public function getAll();
    public function find($id_agendamento);
    public function create(Request $request, $id_agendamentoquest);
    
}
