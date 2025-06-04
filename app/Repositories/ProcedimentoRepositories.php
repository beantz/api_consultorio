<?php

namespace App\Repositories;

use App\Models\Procedimento;
use App\Interfaces\ProcedimentosRepositoriesInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProcedimentoRepositories implements ProcedimentosRepositoriesInterface{

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