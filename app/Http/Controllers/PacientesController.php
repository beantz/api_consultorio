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
        return $this->pacientesService->getAll();
    }

    public function store(ValidationUsersStore $request)
    {
        $request->validated();

        return $this->pacientesService->registerPatients($request);
    }

    public function show(string $id)
    {

        return $this->pacientesService->findPatient($id);

    }

    public function update(Request $request, string $id)
    {
        
        return $this->pacientesService->updatePatient($request, $id);

    }

    public function destroy(string $id)
    {
    
        return $this->pacientesService->deletePatient($id);

    }
}
