<?php

namespace App\Http\Controllers;

use App\Models\Orcamento;
use Illuminate\Http\Request;

class OrcamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orcamentos = Orcamento::all();
        return $orcamentos;
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
        $orcamento = Orcamento::create($request->all());
        return $orcamento;
    }

    /**
     * Display the specified resource.
     */
    public function show(Orcamento $orcamento)
    {
        // $orcamento = Orcamento::find($orcamento->id)->first();
        // return $orcamento;
        echo $orcamento;
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
