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
    // Validar los campos que pueden venir de diferentes juegos (crucigrama, quiz, etc.)
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'scorecrucigrama' => 'nullable|integer', // 'nullable' porque podría no estar presente
        'scorequiz' => 'nullable|integer',
        'scorememorama' => 'nullable|integer',
        'scoresopa' => 'nullable|integer',
    ]);

    // Log para depuración
    \Log::info('Datos recibidos:', $validatedData);

    // Ruta del archivo CSV
    $filePath = storage_path('app/public/game_results.csv');
    
    // Encabezado
    $header = ['name', 'date', 'scorecrucigrama', 'scorequiz', 'scoresopa', 'scorememorama'];

    // Obtener la fecha actual
    $currentDate = now()->format('Y-m-d H:i:s');

    // Abrir el archivo en modo escritura
    $file = fopen($filePath, 'a');

    // Escribir el encabezado si el archivo está vacío
    if (filesize($filePath) == 0) {
        fputcsv($file, $header);
    }

    // Escribir los datos recibidos en el CSV
    fputcsv($file, [
        $validatedData['name'],
        $currentDate,  // Añadir la fecha
        $validatedData['scorecrucigrama'] ?? 'N/A', // Colocar 'N/A' si no se envía puntaje
        $validatedData['scorequiz'] ?? 'N/A',
        $validatedData['scoresopa'] ?? 'N/A',
        $validatedData['scorememorama'] ?? 'N/A',
    ]);

    // Cerrar el archivo
    fclose($file);

    // Respuesta exitosa
    return response()->json(['message' => 'Resultados guardados exitosamente.']);
}

        
}