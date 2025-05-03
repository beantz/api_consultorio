<?php

namespace App\Http\Controllers;

use App\Models\Pacientes;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\ValidationPacientes;

/**
 * controller para fazer gerenciamento do crud de pacientes
 */
class PacientesController extends Controller
{
    use ApiResponse;
    
    /**
     * @return \Illuminate\Http\JsonResponse
     * @response 200 {
     * "status": "success",
     * "message": "Todos os pacientes registrados",
     * "data": [{"id": 1, "nome": "João Silva"}, ...],
     * }
     * 
     */
    public function index()
    {
        try {
            $pacientes = Pacientes::all();
            return $this->success($pacientes, 'Todos os pacientes registrados', 200);
            
        } catch (\Exception $e) {
            
            return $this->error('Falha ao listar pacientes', 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ValidationPacientes $request)
    {
        $request->validated();

        try {
            $paciente = Pacientes::create($request->all());
            return $this->success($paciente, 'Paciente cadastrado com sucesso', 201);
            
        } catch (\Exception $e) {
            
            return $this->error('Falha ao cadastrar paciente', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Lança ModelNotFoundException se não existir
        try {
            $paciente = Pacientes::findOrFail($id);
            return $this->success($paciente, 'Paciente encontrado', 200);

        //recuperar exception e $e recebe uma instancia da exception
        } catch (ModelNotFoundException $e) {
            return $this->error('Paciente não encontrado', 404); 
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $paciente = Pacientes::findOrFail($id);
            $paciente->update($request->all());
            return $this->success($paciente, 'Paciente atualizado com sucesso', 200);
            
        } catch (ModelNotFoundException $e) {
            
            return $this->error("Não foi possível encontrar paciente de id: $id", 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    
        try {
            $paciente = Pacientes::findOrFail($id);
            $paciente->delete();
            return $this->success(null, 'Paciente deletado com sucesso', 200);
            
        } catch (ModelNotFoundException $e) {
            
            return $this->error("Não foi possível encontrar dados de paciente de id: $id", 404);
        }
    }
}
