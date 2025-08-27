<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidationAgendamento;
use App\Models\Agendamento;
use App\Services\AgendamentoService;
use Illuminate\Http\Request;

class AgendamentoController extends Controller
{

    protected $agendamentoService;

    public function __construct(AgendamentoService $agendamentoService)
    {
        $this->agendamentoService = $agendamentoService;
    }
    
    public function index()
    {
        $response = $this->agendamentoService->getAll();

        $code = $response->status();
        return response()->json([$response], $code);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    //ao realizar a avaliação retornar no email do paciente todo o orçamento e relatório da consulta
    public function store(ValidationAgendamento $request)
    {
        
        $response = $this->agendamentoService->registerAppointment($request);

        $code = $response->status();
        return response()->json([$response], $code);
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = $this->agendamentoService->findAppointment($id);

        $code = $response->status();
        return response()->json([$response], $code);

        // $agendamento = Agendamento::find($id);
        // dd($agendamento->users->nome);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ValidationAgendamento $request, string $id)
    {
        $response = $this->agendamentoService->updateAppointment($request, $id);

        $code = $response->status();
        return response()->json([$response], $code);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = $this->agendamentoService->deleteAppointment($id);

        $code = $response->status();
        return response()->json([$response], $code);
    }
}
