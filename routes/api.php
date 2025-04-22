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