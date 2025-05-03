<?php

namespace App\Http\Controllers;

use App\Models\Procedimento;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProcedimentoController extends Controller
{

    use ApiResponse;

    /**
     * 
     */
    public function index()
    {
        try {
            $procedimentos = Procedimento::all();
            return $this->success($procedimentos, "Todos os procedimentos", 200);

        } catch (\Exception $e) {
            return $this->error("Erro ao buscar procedimentos", 500, $e);
        } 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validações


        try {
            $procedimento = Procedimento::create($request->all());
            
            return $this->success($procedimento, "Procedimento cadastrado!", 201);
        } catch (\Exception $e){

            $this->error("Erro ao cadastrar procedimento", 500 ,$e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $procedimento = Procedimento::findOrFail($id);

            return $this->success($procedimento, "Procedimento encontrado!", 201);
        } catch (ModelNotFoundException $e) {

            return $this->error("Erro ao buscar procedimento de id: $id", 404, $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $procedimento = Procedimento::findOrFail($id);
            $procedimento->update($request->all());

            return $this->success($procedimento, "Procedimento atualizado com sucesso!", 200);
        } catch (ModelNotFoundException $e) {

            return $this->error("Erro ao buscar procedimento de id: $id", 404, $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $procedimento = Procedimento::findOrFail($id);
            $procedimento->delete();
            return $this->success(null, 'Procedimento deletado com sucesso', 200);
            
        } catch (ModelNotFoundException $e) {
            
            return $this->error("Não foi possível encontrar procedimento de id: $id", 404);
        }
    }
}
