<?php

namespace App\Http\Repositories;

use App\Models\Procedimento;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProcedimentoRepositories {

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

}