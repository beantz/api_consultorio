<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PacientesController;
use App\Http\Controllers\ProcedimentoController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login'])->name('usuario.login');
Route::post('/register', [AuthController::class, 'register'])->name('usuario.register');
Route::post('/logout', [AuthController::class, 'logout'])->name('usuario.logout');
Route::post('/refresh', [AuthController::class, 'refresh'])->name('usuario.refresh');

Route::middleware('auth:api')->prefix('Pacientes')->group( function() {
    Route::get('Pacientes', [PacientesController::class, 'index'])->name('pacientes.index');
    Route::post('/Cadastrar', [PacientesController::class, 'store'])->name('pacientes.store');
    Route::put('/Atualizar/{id}', [PacientesController::class, 'update'])->name('pacientes.update');
    Route::delete('/Deletar/{id}', [PacientesController::class, 'destroy'])->name('pacientes.destroy');
});

Route::get('Pacientes/Visualizar/{id}', [PacientesController::class, 'show'])->name('pacientes.show');

Route::get('Procedimentos', [ProcedimentoController::class, 'index'])->name('procedimento.index');
Route::get('Procedimentos/Visualizar/{id}', [ProcedimentoController::class, 'show'])->name('procedimento.visualizar');

Route::middleware('auth:api')->prefix('/Procedimentos')->group( function() {
    Route::post('/Cadastrar', [ProcedimentoController::class, 'store'])->name('procedimento.cadastrar');
    Route::put('/Atualizar/{id}', [ProcedimentoController::class, 'update'])->name('procedimento.atualizar');
    Route::delete('/Deletar/{id}', [ProcedimentoController::class, 'destroy'])->name('procedimento.deletar');

});

//Route::post('Admin/Register', [AdminController::class, 'registeredByAdmin']);
