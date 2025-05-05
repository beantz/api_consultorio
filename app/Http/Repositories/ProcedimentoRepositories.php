<?php

namespace App\Http\Repositories;

use App\Models\Procedimento;

class ProcedimentoRepositories {

    public function getAllProcedures() {
        $procedimentos = Procedimento::all();
        return $procedimentos;
    }

    public function createProcedures($request) {
        $procedimentos = Procedimento::create($request->all());
        return $procedimentos;
    }

}