<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use App\Http\Requests\ValidationUsersStore;
use App\Facades\PacientesServicesFacades;
use App\Services\PacientesService;

/**
 * controller para fazer gerenciamento do crud de pacientes
 */
class PacientesController extends Controller
{
    use ApiResponse;

    protected $pacientesService;

    public function __construct(PacientesService $pacientesService)
    {
        $this->pacientesService = $pacientesService;
    }

    public function index()
    {
        $response = $this->pacientesService->getAll();
        //resgatando o codigo para vindo do service e mandando pelo json no controller
        $code = $response->status();
        return response()->json([$response], $code);
    }

    public function store(ValidationUsersStore $request)
    {
        $request->validated();
        $response = $this->pacientesService->registerPatients($request);

        $code = $response->status();
        return response()->json([$response], $code);
        
    }

    public function show(string $id)
    {
        $response = $this->pacientesService->findPatient($id);

        $code = $response->status();
        return response()->json([$response], $code);

    }

    public function update(Request $request, string $id)
    {
        
        $response = $this->pacientesService->updatePatient($request, $id);

        $code = $response->status();
        return response()->json([$response], $code);

    }

    public function destroy(string $id)
    {
    
        $response = $this->pacientesService->deletePatient($id);

        $code = $response->status();
        return response()->json([$response], $code);

    }
}
