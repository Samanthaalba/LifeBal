<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GameResult;

class GameResultController extends Controller
{
    public function storeFinalResult(Request $request)
    {
        // Validar los datos recibidos
        $validatedData = $request->validate([
            'user_name' => 'required|string|max:255',
            'total_time' => 'required|integer',
            'total_score' => 'required|integer',
        ]);

        // Ruta del archivo CSV
        $filePath = storage_path('app/public/game_results.csv');

        try {
            // Verificar si el archivo CSV ya existe, si no, crear el archivo y añadir los encabezados
            if (!file_exists($filePath)) {
                $header = ['Nombre', 'Tiempo Total', 'Puntuación Total', 'Fecha y Hora'];
                $file = fopen($filePath, 'w');
                fputcsv($file, $header);
                fclose($file);
            }

            // Abrir el archivo en modo de escritura y añadir la nueva fila de resultados
            $file = fopen($filePath, 'a');
            $data = [
                $validatedData['user_name'],
                $validatedData['total_time'],
                $validatedData['total_score'],
                now()->toDateTimeString(), // Guardar la fecha y hora actuales
            ];
            fputcsv($file, $data);
            fclose($file);

            return response()->json([
                'message' => 'Resultados almacenados con éxito',
                'result' => $data,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error al almacenar los resultados: ' . $e->getMessage()); // Añadir mensaje de error al log
            return response()->json([
                'message' => 'Error al almacenar los resultados',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}