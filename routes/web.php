<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SopaDeLetrasController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\MemoramaController;
use App\Http\Controllers\CrucigramaController;
use App\Http\Controllers\GameResultController;

Route::get('/', function () { return view('login'); });
Route::get('/inicio', function () { return view('inicio'); });
Route::get('/juegos/memorama', [MemoramaController::class, 'show']);
Route::get('/juegos/sopa_letras', [SopaDeLetrasController::class, 'index']);
Route::get('/juegos/quiz', [QuizController::class, 'show'])->name('quiz.show');
Route::post('/juegos/quiz', [QuizController::class, 'process'])->name('quiz.process');
Route::get('/juegos/crucigrama', [CrucigramaController::class, 'index']);

Route::post('/save-result', [CrucigramaController::class, 'saveResult']);
Route::post('/save-result/totales', [CrucigramaController::class, 'saveResult']);

// Rutas para guardar los resultados individuales de cada juego
Route::post('/save-result/memorama', [MemoramaController::class, 'saveResult']);
Route::post('/save-result/sopa_letras', [SopaDeLetrasController::class, 'saveResult']);
Route::post('/save-result/quiz', [QuizController::class, 'saveResult']);


// Ruta para guardar los resultados totales
Route::post('/save-result/totales', [GameResultController::class, 'storeFinalResult']);
