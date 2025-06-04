<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidationProcedimentos;
use App\Services\ProcedimentoServices;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Facades\ProcedimentoServicesFacades;

class ProcedimentoController extends Controller
{

    use ApiResponse;

    public function index()
    {
        return ProcedimentoServicesFacades::getAllProcedures();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ValidationProcedimentos $request)
    {
        $request->validated();

        return ProcedimentoServicesFacades::createProcedures($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return ProcedimentoServicesFacades::show($id);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return ProcedimentoServicesFacades::update($request, $id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return ProcedimentoServicesFacades::destroy($id);

    }
}
