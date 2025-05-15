<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use App\Http\Requests\ValidationPacientes;
use App\Http\Requests\ValidationUsers;
use App\Http\Requests\ValidationUsersStore;
use App\Http\Services\PacientesServices;

/**
 * controller para fazer gerenciamento do crud de pacientes
 */
class PacientesController extends Controller
{
    use ApiResponse;
    
    protected $pacientesServices;

    public function __construct(PacientesServices $PacientesServices)
    {
        $this->pacientesServices = $PacientesServices;
    }

    public function index()
    {
        return $this->pacientesServices->getAllPatients();

    }

    public function store(ValidationUsersStore $request)
    {
        $request->validated();

        return $this->pacientesServices->registerPatients($request);
    }

    public function show(string $id)
    {

        return $this->pacientesServices->findPatient($id);

    }

    public function update(Request $request, string $id)
    {
        
        return $this->pacientesServices->updatePatient($request, $id);

    }

    public function destroy(string $id)
    {
    
        return $this->pacientesServices->deletePatient($id);

    }
}
