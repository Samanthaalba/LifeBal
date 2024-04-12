<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrucigramaController;

// Ruta para cargar palabras y pistas
Route::get('/palabras', [CrucigramaController::class, 'cargarPalabras']);

// Ruta para verificar respuestas
Route::post('/verificar-respuesta', [CrucigramaController::class, 'verificarRespuesta']);

