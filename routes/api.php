<?php

use App\Http\Controllers\PacientesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    // return $request->user();
    return 'rota api';
});
// ->middleware('auth:sanctum');

Route::get('Pacientes', [PacientesController::class, 'index'])->name('pacientes.index');
Route::post('Pacientes/Cadastrar', [PacientesController::class, 'store'])->name('pacientes.store');
Route::get('Pacientes/Visualizar/{id}', [PacientesController::class, 'show'])->name('pacientes.show');
Route::put('Pacientes/Atualizar/{id}', [PacientesController::class, 'update'])->name('pacientes.update');
Route::delete('Pacientes/Deletar/{id}', [PacientesController::class, 'destroy'])->name('pacientes.destroy');