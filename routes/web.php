<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameResultController;
use App\Http\Controllers\SopaDeLetrasController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\MemoramaController;
use App\Http\Controllers\CrucigramaController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


Route::get('/', function () {
    $filePath = storage_path('app/visit-count.txt');
    $visitCount = 0;

    // Lee el número de visitas del archivo
    if (File::exists($filePath)) {
        $visitCount = (int) File::get($filePath);
    }

    // Incrementa el número de visitas
    $visitCount++;

    // Guarda el nuevo número de visitas en el archivo
    File::put($filePath, $visitCount);

    // Carga la vista principal
    return view('login');
});

// Ruta para obtener el número actual de visitas
Route::get('/visit-count', function() {
    $filePath = storage_path('app/visit-count.txt');
    $visitCount = 0;

    // Lee el número de visitas del archivo
    if (File::exists($filePath)) {
        $visitCount = (int) File::get($filePath);
    }

    // Devuelve el número de visitas en formato JSON
    return response()->json(['visitCount' => $visitCount]);
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

Route::get('/download-results', function() {
    $filePath = Storage::disk('public')->path('game_results.csv'); // Obtener la ruta correcta del archivo CSV en el disco público

    if (file_exists($filePath)) {
        return response()->download($filePath, 'resultados_jugadores.csv');
    } else {
        return response()->json(['message' => 'No hay resultados disponibles para descargar.'], 404);
    }
})->name('downloadResults');


