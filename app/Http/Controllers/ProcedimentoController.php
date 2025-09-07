<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidationProcedimentos;
use App\Services\ProcedimentoService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ProcedimentoController extends Controller
{

    use ApiResponse;

    protected $procedimentoService;

    public function __construct(ProcedimentoService $procedimentoService)
    {
        $this->procedimentoService = $procedimentoService;
    }

    public function index()
    {
        $response = $this->procedimentoService->getAllProcedures();

        $code = $response->status();
        return response()->json([$response], $code);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ValidationProcedimentos $request)
    {
        $request->validated();

        $response = $this->procedimentoService->createProcedures($request);

        $code = $response->status();
        return response()->json([$response], $code);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = $this->procedimentoService->show($id);

        $code = $response->status();
        return response()->json([$response], $code);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $response = $this->procedimentoService->update($request, $id);

        $code = $response->status();
        return response()->json([$response], $code);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = $this->procedimentoService->destroy($id);

        $code = $response->status();
        return response()->json([$response], $code);

    }

    //método que retornem usuarios de um procedimentos especifico
    public function patientsByProcedures(string $id_procedimento)
    {
        $response = $this->procedimentoService->patientsByProcedures($id_procedimento);

        $code = $response->status();
        return response()->json([$response], $code);

    }

}
