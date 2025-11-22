<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use App\Http\Requests\ValidationUsersStore;
use App\Facades\PacientesServicesFacades;
use App\Models\User;
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
        return response()->json($response);
    }

    public function store(ValidationUsersStore $request)
    {
        $request->validated();
        $response = $this->pacientesService->registerPatients($request);

        return response()->json($response);
        
    }

    public function show(string $id)
    {
        $response = $this->pacientesService->findPatient($id);

        return response()->json($response);
    }

    public function update(Request $request, string $id)
    {
        
        $response = $this->pacientesService->updatePatient($request, $id);

        return response()->json($response);

    }

    public function destroy(string $id)
    {
    
        $response = $this->pacientesService->deletePatient($id);

        return response()->json($response);

    }
}
