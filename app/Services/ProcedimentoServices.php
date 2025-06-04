<?php

namespace App\Services;

use App\Traits\ApiResponse;
use App\Repositories\ProcedimentoRepositories;
use App\Models\Procedimento;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Facades\ProcedimentoRepositoryFacades;

class ProcedimentoServices {

    use ApiResponse;

    public function getAllProcedures()
    {
        try {
            
            $procedimentos = ProcedimentoRepositoryFacades::getAllProcedures();

            return $this->success($procedimentos, "Todos os procedimentos", 200);

        } catch (\Exception $e) {
            return $this->error("Erro ao buscar procedimentos", 500, $e);
        } 
    }

    public function createProcedures(Request $request)
    {

        try {
            $procedimento = ProcedimentoRepositoryFacades::createProcedures($request);
            
            return $this->success($procedimento, "Procedimento cadastrado!", 201);
        } catch (\Exception $e){

            $this->error("Erro ao cadastrar procedimento", 500 ,$e);
        }
    }

    public function show($id) {

        try {
            
            $procedimento = ProcedimentoRepositoryFacades::findProcedure($id);

            return $this->success($procedimento, "Procedimento encontrado!", 201);
        } catch (ModelNotFoundException $e) {

            return $this->error("Erro ao buscar procedimento de id: $id", 404, $e->getMessage());
        }

    }

    public function update($request, $id) {

        try {
            $procedimento = ProcedimentoRepositoryFacades::findProcedure($id);
            $procedimento->update($request->all());

            return $this->success($procedimento, "Procedimento atualizado com sucesso!", 200);
        } catch (ModelNotFoundException $e) {

            return $this->error("Erro ao buscar procedimento de id: $id", 404, $e->getMessage());
        }

    }

    public function destroy($id) {

        try {
            $procedimento = ProcedimentoRepositoryFacades::findProcedure($id);
            $procedimento->delete();
            return $this->success(null, 'Procedimento deletado com sucesso', 200);
            
        } catch (ModelNotFoundException $e) {
            
            return $this->error("Não foi possível encontrar procedimento de id: $id", 404);
        }

    }

}