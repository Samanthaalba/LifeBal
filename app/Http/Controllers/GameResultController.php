<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\CrucigramaController;

class GameResultController extends Controller
{
    public function storeFinalResult(Request $request)
{
    $validatedData = $request->validate([
        'game_name' => 'required|string|max:255',
        'total_score' => 'required|integer',
        'total_time' => 'required|integer',
        'user_name' => 'required|string|max:255',
    ]);

    $filePath = Storage::path('public/game_results.csv');
    $header = ['user_name', 'game_name', 'total_score', 'total_time'];

    // Verifica si el archivo existe
    $fileExists = file_exists($filePath);
    
    // Log para depuración
    \Log::info("Ruta del archivo CSV: " . $filePath);
    \Log::info("El archivo existe: " . ($fileExists ? 'Sí' : 'No'));
    \Log::info('Guardando en CSV:', $validatedData);


    // Abre el archivo en modo append
    $file = fopen($filePath, 'a');

    // Si el archivo no existe, escribe el encabezado
    if (!$fileExists) {
        fputcsv($file, $header);
    }

    // Escribe los datos en el archivo CSV
    fputcsv($file, [
        $validatedData['user_name'],
        $validatedData['game_name'],
        $validatedData['total_score'],
        $validatedData['total_time'],
    ]);

    fclose($file);

    return response()->json(['message' => 'Resultado guardado exitosamente.']);
}


}
