<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\AgendamentoProcedimento;
use App\Services\AgendamentoProcedimentoService;
use Illuminate\Http\Request;

class AgendamentoProcedimentoController extends Controller
{
    protected $agendamentoProcedimentoService;

    public function __construct(AgendamentoProcedimentoService $agendamentoProcedimentoService)
    {
        $this->agendamentoProcedimentoService = $agendamentoProcedimentoService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = $this->agendamentoProcedimentoService->getAll();
        $code = $response->status();

        return response()->json([$response], $code);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id_agendamento)
    {
        $response = $this->agendamentoProcedimentoService->registerAppointmentProcedure($request, $id_agendamento);
        $code = $response->status();

        return response()->json([$response], $code);
    }

    /**
     * Display the specified resource.
     */
    public function show($id_agendamento)
    {
        $response = $this->agendamentoProcedimentoService->findAppointmentProcedure($id_agendamento);
        $code = $response->status();

        return response()->json([$response], $code);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AgendamentoProcedimento $agendamentoProcedimento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AgendamentoProcedimento $agendamentoProcedimento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_agendamento)
    {
        $response = $this->agendamentoProcedimentoService->deleteAppointmentProcedure($id_agendamento);
        $code = $response->status();

        return response()->json([$response], $code);
    }
}
