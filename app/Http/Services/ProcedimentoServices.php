<?php

namespace App\Http\Services;

use App\Traits\ApiResponse;
use App\Http\Repositories\ProcedimentoRepositories;
use App\Models\Procedimento;
use Illuminate\Http\Request;

class ProcedimentoServices {

    use ApiResponse;

    protected $procedimentoRepositories;

    public function __construct(ProcedimentoRepositories $procedimentoRepositories)
    {
        $this->procedimentoRepositories = $procedimentoRepositories;
    }

    public function getAllProcedures()
    {
        try {
            $procedimentos = $this->procedimentoRepositories->getAllProcedures();
            return $this->success($procedimentos, "Todos os procedimentos", 200);

        } catch (\Exception $e) {
            return $this->error("Erro ao buscar procedimentos", 500, $e);
        } 
    }

    public function createProcedures(Request $request)
    {

        try {
            $procedimento = $this->procedimentoRepositories->createProcedures($request);
            
            return $this->success($procedimento, "Procedimento cadastrado!", 201);
        } catch (\Exception $e){

            $this->error("Erro ao cadastrar procedimento", 500 ,$e);
        }
    }

}