<?php

namespace App\Repositories;

use App\Models\Procedimento;
use App\Interfaces\ProcedimentosRepositoriesInterface;

class ProcedimentoRepositorie implements ProcedimentosRepositoriesInterface{

    public function getAllProcedures() {
        $procedimentos = Procedimento::all();
        return $procedimentos;
    }

    public function createProcedures($request) {
        $procedimentos = Procedimento::create($request->all());
        return $procedimentos;
    }

    public function findProcedure($id) {
    
        $procedimento = Procedimento::findOrFail($id);
        return $procedimento;
    }

    public function patientsByProcedures($id_procedimento) {
        $procedimento = Procedimento::where('id', $id_procedimento)->first();
        return $procedimento;
    }

}