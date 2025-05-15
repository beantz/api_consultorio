<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidationProcedimentos;
use App\Http\Services\ProcedimentoServices;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ProcedimentoController extends Controller
{

    use ApiResponse;

    protected $procedimentoServices;

    public function __construct(ProcedimentoServices $procedimentoServices)
    {
        $this->procedimentoServices = $procedimentoServices;
    }

    public function index()
    {
        return $this->procedimentoServices->getAllProcedures();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ValidationProcedimentos $request)
    {
        $request->validated();

        return $this->procedimentoServices->createProcedures($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->procedimentoServices->show($id);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->procedimentoServices->update($request, $id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->procedimentoServices->destroy($id);

    }
}
