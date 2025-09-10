<?php

namespace App\Services;

use App\Traits\ApiResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Facades\PacientesRepositoriesFacades;
use App\Repositories\OrcamentoRepositorie;

class OrcamentoService {

    use ApiResponse;

    protected $orcamentoRepositories;

    public function __construct(OrcamentoRepositorie $orcamentoRepositories)
    {
        $this->orcamentoRepositories = $orcamentoRepositories;
    }

    /**
     * @return \Traits\ApiResponse
     * @response 200 {
     * "data": [{"id": 1, "nome": "João Silva"}, ...]
     * "message": "Todos os pacientes registrados",
     * "code": "200",
     * }
     * 
     */
    public function getAll() {

        try {
            $orcamentos = $this->orcamentoRepositories->getAll();
            return $this->success($orcamentos, 'Todos os Orçamentos registrados', 200);
            
        } catch (\Exception $e) {
            
            return response()->json(['Falha ao listar orçamentos', 500, $e->getMessage()]);
        }

    }

    public function create($request) {

        try {
            $orcamentos = $this->orcamentoRepositories->create($request);
            return $this->success($orcamentos, 'Orçamento criado com sucesso', 201);
            
        } catch (\Exception $e) {
            
            return response()->json(['Falha ao listar orçamentos', 500, $e->getMessage()]);
        }

    }

}