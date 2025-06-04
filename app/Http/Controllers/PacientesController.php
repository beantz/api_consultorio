<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use App\Http\Requests\ValidationUsersStore;
use App\Facades\PacientesServicesFacades;

/**
 * controller para fazer gerenciamento do crud de pacientes
 */
class PacientesController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return PacientesServicesFacades::getAllPatients();

    }

    public function store(ValidationUsersStore $request)
    {
        $request->validated();

        return PacientesServicesFacades::registerPatients($request);
    }

    public function show(string $id)
    {

        return PacientesServicesFacades::findPatient($id);

    }

    public function update(Request $request, string $id)
    {
        
        return PacientesServicesFacades::updatePatient($request, $id);

    }

    public function destroy(string $id)
    {
    
        return PacientesServicesFacades::deletePatient($id);

    }
}
