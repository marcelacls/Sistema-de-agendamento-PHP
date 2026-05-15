<?php

use App\Http\Controllers\PacienteController;
use App\Http\Controllers\DentistaController;
use App\Http\Controllers\ConsultaController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('home'))->name('home');

Route::resource('pacientes', PacienteController::class)
    ->only(['index', 'create', 'store', 'destroy']);

Route::resource('dentistas', DentistaController::class)
    ->only(['index', 'create', 'store', 'destroy']);

Route::resource('consultas', ConsultaController::class)
    ->only(['index', 'create', 'store', 'destroy']);

// Ações extras de status (espelhando o padrão do sistema de quadra)
Route::post('consultas/{consulta}/confirmar', [ConsultaController::class, 'confirmar'])
    ->name('consultas.confirmar');

Route::post('consultas/{consulta}/cancelar',  [ConsultaController::class, 'cancelar'])
    ->name('consultas.cancelar');
