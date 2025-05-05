<?php

namespace App\Http\Controllers;

use App\Models\Pacientes;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\ValidationPacientes;
use App\Http\Services\PacientesServices;
use App\Models\User;

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

    public function store(ValidationPacientes $request)
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
