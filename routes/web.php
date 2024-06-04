<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameResultController;
use App\Http\Controllers\SopaDeLetrasController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\MemoramaController;
use App\Http\Controllers\CrucigramaController;

Route::get('/', function () {
    return view('login');
});

Route::get('/inicio', function () {
    return view('inicio');
});

Route::get('/juegos/crucigrama', [CrucigramaController::class, 'index'])->name('crucigrama.index');
Route::post('/crucigrama/save-result', [CrucigramaController::class, 'saveResult'])->name('crucigrama.saveResult');

Route::get('/juegos/memorama', [MemoramaController::class, 'show'])->name('memorama.show');
Route::post('/memorama/save-result', [MemoramaController::class, 'saveResult'])->name('memorama.saveResult');

Route::get('/juegos/quiz', [QuizController::class, 'show'])->name('quiz.show');
Route::post('/quiz/process', [QuizController::class, 'process'])->name('quiz.process');
Route::post('/quiz/save-result', [QuizController::class, 'saveResult'])->name('quiz.saveResult');

Route::get('/juegos/sopa_letras', [SopaDeLetrasController::class, 'index'])->name('sopaLetras.index');
Route::post('/sopa_letras/save-result', [SopaDeLetrasController::class, 'saveResult'])->name('sopaLetras.saveResult');

Route::post('/store-final-result', [GameResultController::class, 'storeFinalResult'])->name('storeFinalResult');
