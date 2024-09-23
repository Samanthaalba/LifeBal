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
        // Validar los datos recibidos
        $validatedData = $request->validate([
            'sessionId' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'score' => 'required|integer',
            'time' => 'required|integer',
            'attempts' => 'required|integer'
        ]);
    
        // Log para depuración
        \Log::info('Datos recibidos:', $validatedData);
    
        // Ruta del archivo CSV en el sistema de almacenamiento público de Laravel (storage/app/public)
        $filePath = storage_path('app/public/game_results.csv');
        $header = ['sessionId', 'name', 'score', 'time', 'attempts'];
    
        // Verificar si el archivo existe
        $fileExists = file_exists($filePath);
    
        // Abrir el archivo en modo de escritura (crea el archivo si no existe)
        $file = fopen($filePath, 'a'); // 'a' para escribir al final del archivo o crearlo si no existe
    
        // Si el archivo no existe, escribir el encabezado
        if (!$fileExists) {
            fputcsv($file, $header);
        }
    
        // Escribir los datos validados en el archivo CSV
        fputcsv($file, [
            $validatedData['sessionId'],
            $validatedData['name'],
            $validatedData['score'],
            $validatedData['time'],
            $validatedData['attempts'],
        ]);
    
        // Cerrar el archivo
        fclose($file);
    
        // Devolver una respuesta exitosa
        return response()->json(['message' => 'Resultados guardados exitosamente.']);
    }
}
