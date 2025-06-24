<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidationProcedimentos;
use App\Services\ProcedimentoService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Facades\ProcedimentoServicesFacades;

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
        return $this->procedimentoService->getAllProcedures();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ValidationProcedimentos $request)
    {
        $request->validated();

        return $this->procedimentoService->createProcedures($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->procedimentoService->show($id);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->procedimentoService->update($request, $id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->procedimentoService->destroy($id);

    }
}
