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
        return response()->json($this->pacientesService->getAll());
    }

    public function store(ValidationUsersStore $request)
    {
        $request->validated();
        $response = $this->pacientesService->registerPatients($request);
        
        /*dessa forma para que seja encaminhado o statuscode que é enviado pelo service*/
        $statusCode = (string) $response['status'];

        if($statusCode === '.E500'){
            return response()->json($response, 201);
        } else {
            return response()->json($response , $statusCode);
        }
        
    }

    public function show(string $id)
    {
        return response()->json($this->pacientesService->findPatient($id));
    }

    public function update(Request $request, string $id)
    {
        
        $response = $this->pacientesService->updatePatient($request, $id);

        $statusCode = (string) $response['status'];

        if($statusCode === '.E404'){
            return response()->json($response, 200);
        } else {
            return response()->json($response , $statusCode);
        }

    }

    public function destroy(string $id)
    {
    
        $response = $this->pacientesService->deletePatient($id);

        $statusCode = (string) $response['status'];

        if($statusCode === '.E404'){
            return response()->json($response, 200);
        } else {
            return response()->json($response , $statusCode);
        }

    }
}
