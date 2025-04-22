<?php

namespace App\Http\Controllers;

use App\Models\Pacientes;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use PhpParser\Node\Stmt\TryCatch;

class PacientesController extends Controller
{
    use ApiResponse;
    
    public function index()
    {
        $pacientes = Pacientes::all();

        try {
            return $this->success($pacientes, 'Todos os pacientes registrados', 200);
            
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return $this->error('Falha ao listar pacientes', 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $paciente = Pacientes::create($request->all());

        try {
            return $this->success($paciente, 'Paciente cadastrado com sucesso', 200);
            
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return $this->error('Falha ao cadastrar paciente', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $paciente = Pacientes::find($id, 'id')->get();

        try {
            return $this->success($paciente, 'Paciente encontrado com sucesso', 200);
            
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return $this->error("Falha ao procurar paciente de id: $id", 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Pacientes::find($id, 'id')->update($request->all());
        $paciente = Pacientes::find($id, 'id')->get();

        try {
            return $this->success($paciente, 'Paciente atualizado com sucesso', 200);
            
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return $this->error("Falha ao atualizar dados de paciente de id: $id", 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $paciente = Pacientes::find($id, 'id')->delete();
    
        try {
            return $this->success(null, 'Paciente deletado com sucesso', 200);
            
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return $this->error("Falha ao deletar dados de paciente de id: $id", 500);
        }
    }
}
