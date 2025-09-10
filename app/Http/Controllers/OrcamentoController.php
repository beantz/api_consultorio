<?php

namespace App\Http\Controllers;

use App\Models\Orcamento;
use App\Services\OrcamentoService;
use Illuminate\Http\Request;

class OrcamentoController extends Controller
{
    protected $orcamentoService;

    public function __construct(OrcamentoService $orcamentoService)
    {
        $this->orcamentoService = $orcamentoService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = $this->orcamentoService->getAll();

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
    public function store(Request $request)
    {
        $response = $this->orcamentoService->create($request);

        $code = $response->status();
        return response()->json([$response], $code);
    }

    /**
     * Display the specified resource.
     */
    public function show(Orcamento $orcamento)
    {
        return response()->json($orcamento);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orcamento $orcamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Orcamento $orcamento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orcamento $orcamento)
    {
        $orcamento->delete();

        return response()->json("Orçamento deletado");
    }
}
