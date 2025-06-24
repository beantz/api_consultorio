<?php

namespace App\Services;

use App\Repositories\PacientesRepositorie;
use App\Models\Pacientes;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Facades\PacientesRepositoriesFacades;

class PacientesService {

    use ApiResponse;

    protected $pacientesRepositories;

    public function __construct(PacientesRepositorie $pacientesRepositories)
    {
        $this->pacientesRepositories = $pacientesRepositories;
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
            $pacientes = $this->pacientesRepositories->getAllUsers();
            return $this->success($pacientes, 'Todos os pacientes registrados', 200);
            
        } catch (\Exception $e) {
            
            return $this->error('Falha ao listar pacientes', 500, $e->getMessage());
        }

    }

    /**
     * Store a newly created resource in storage.
     * @return \Traits\ApiResponse
     * @response 200 {
     * "data": [{"id": 1, "nome": "João Silva"}, ...]
     * "message": "Paciente cadastrado",
     * "code": "201",
     */
    public function registerPatients($request) {

        try {
            $paciente = $this->pacientesRepositories->create($request);
            return $this->success($paciente, 'Paciente cadastrado com sucesso', 201);
            
        } catch (\Exception $e) {
            
            return $this->error('Falha ao cadastrar paciente', 500, $e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     * @return \Traits\ApiResponse
     * @response 200 {
     * "data": [{"id": 1, "nome": "João Silva"}, ...]
     * "message": "Paciente encontrado",
     * "code": "200",
     */
    public function findPatient($id) {

        try {
            
            $pacientes = $this->pacientesRepositories->getAllUsers();
            
            $paciente = $pacientes->find($id);

            if(is_null($paciente)){
                return $this->error("Paciente de id: $id não encontrado!", 404);
            }
            return $this->success($paciente, 'Paciente encontrado', 200);

        //recuperar exception e $e recebe uma instancia da exception
        } catch (\Exception $e) {
            return $this->error('Paciente não encontrado', 404, $e->getMessage()); 
        }

    }

    /**
     * Update the specified resource in storage.
     * @return \Traits\ApiResponse
     * @response 200 {
     * "data": [{"id": 1, "nome": "João Silva"}, ...]
     * "message": "Paciente atualizado com sucesso",
     * "code": "200",
     */
    public function updatePatient($request, $id) {

        try {
            
            $pacientes = $this->pacientesRepositories->getAllUsers();
            $paciente = $pacientes->find($id);

            if(is_null($paciente)){
                return $this->error("Paciente de id: $id não encontrado!", 404);
            }
            
            $paciente->update($request->all());
            return $this->success($paciente, 'Paciente atualizado com sucesso', 200);
            
        } catch (\Exception $e) {
            
            return $this->error("Não foi possível atualizar paciente de id: $id", 404, $e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     *  @return \Traits\ApiResponse
     * @response 200 {
     * "data": null
     * "message": "Paciente deletado com sucesso",
     * "code": "200",
     */
    public function deletePatient($id) {

        try {
            $pacientes = $this->pacientesRepositories->getAllUsers();
            $paciente = $pacientes->find($id);

            if(is_null($paciente)){
                return $this->error("Paciente de id: $id não encontrado!", 404);
            }

            $paciente->delete();
            return $this->success(null, 'Paciente deletado com sucesso', 200);
            
        } catch (\Exception $e) {
            
            return $this->error("Não foi possível deletar paciente de id: $id", 404);
        }

    }

}