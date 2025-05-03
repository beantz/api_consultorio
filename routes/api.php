<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PacientesController;
use App\Http\Controllers\UserController;
use Faker\Guesser\Name;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::middleware('auth:api')->post('/logout', [AuthController::class, 'logout'])->name('usuarios.logout');
Route::post('/register', [UserController::class, 'store'])->name('usuario.register');

Route::get('Pacientes', [PacientesController::class, 'index'])->name('pacientes.index');
Route::middleware('auth:api')->post('/Pacientes/Cadastrar', [PacientesController::class, 'store'])->name('pacientes.store');
Route::get('Pacientes/Visualizar/{id}', [PacientesController::class, 'show'])->name('pacientes.show');
Route::put('Pacientes/Atualizar/{id}', [PacientesController::class, 'update'])->name('pacientes.update');
Route::delete('Pacientes/Deletar/{id}', [PacientesController::class, 'destroy'])->name('pacientes.destroy');

//Route::post('/user', [UserController::class, 'store'])->middleware('auth:sanctum')->name('user.store');