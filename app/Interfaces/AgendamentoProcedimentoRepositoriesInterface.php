<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface AgendamentoProcedimentoRepositoriesInterface {
    
    public function getAll();
    public function create(Request $request, $id_agendamentoquest);
    
}
