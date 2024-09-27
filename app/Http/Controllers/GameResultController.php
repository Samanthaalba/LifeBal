<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\CrucigramaController;


    class GameResultController extends Controller
    {
        public function storeFinalResult(Request $request)
{
    // Validar los datos que llegan del formulario
    $validatedData = $request->validate([
        'player_id' => 'nullable|integer', // Player ID si ya existe
        'name' => 'required|string|max:255',
        'scorecrucigrama' => 'nullable|integer',
        'scorequiz' => 'nullable|integer',
        'scorememorama' => 'nullable|integer',
        'scoresopa' => 'nullable|integer',
    ]);

    // Ruta al archivo CSV
    $filePath = storage_path('app/public/game_results.csv');

    // Definir el encabezado del CSV
    $header = ['player_id', 'name', 'date', 'scorecrucigrama', 'scorequiz', 'scoresopa', 'scorememorama'];

    // Obtener la fecha actual
    $currentDate = Carbon::now()->toDateTimeString();

    // Variable para almacenar las filas existentes
    $rows = [];
    $playerUpdated = false;
    $playerId = $validatedData['player_id'] ?? null;

    // Abrir el archivo para lectura/escritura
    $file = fopen($filePath, 'c+');

    if (flock($file, LOCK_EX)) { // Bloquear el archivo para evitar accesos simultáneos
        // Leer el archivo CSV si ya tiene datos
        if (filesize($filePath) > 0) {
            fgetcsv($file); // Ignorar el encabezado

            // Leer cada fila del archivo CSV
            while (($row = fgetcsv($file)) !== false) {
                // Comprobar si el jugador ya existe y no se ha actualizado
                if ($row[0] === (string)$playerId || $row[1] === $validatedData['name']) {
                    // Si ya hay puntajes no actualizar los valores
                    if ($row[3] !== 'N/A' && isset($validatedData['scorecrucigrama'])) {
                        $validatedData['scorecrucigrama'] = $row[3]; // Mantener el puntaje original
                    }
                    if ($row[4] !== 'N/A' && isset($validatedData['scorequiz'])) {
                        $validatedData['scorequiz'] = $row[4];
                    }
                    if ($row[5] !== 'N/A' && isset($validatedData['scoresopa'])) {
                        $validatedData['scoresopa'] = $row[5];
                    }
                    if ($row[6] !== 'N/A' && isset($validatedData['scorememorama'])) {
                        $validatedData['scorememorama'] = $row[6];
                    }

                    // Actualizar la fila con la nueva información solo si no ha jugado antes
                    $row[3] = $validatedData['scorecrucigrama'] ?? $row[3];
                    $row[4] = $validatedData['scorequiz'] ?? $row[4];
                    $row[5] = $validatedData['scoresopa'] ?? $row[5];
                    $row[6] = $validatedData['scorememorama'] ?? $row[6];
                    $playerUpdated = true;
                }
                $rows[] = $row;
            }
        }

        // Si el jugador no existe, crear un nuevo registro
        if (!$playerUpdated) {
            $newPlayerId = count($rows) > 0 ? (int)end($rows)[0] + 1 : 1; // Generar nuevo player_id secuencial
            $rows[] = [
                $newPlayerId,
                $validatedData['name'],
                $currentDate,
                $validatedData['scorecrucigrama'] ?? 'N/A',
                $validatedData['scorequiz'] ?? 'N/A',
                $validatedData['scoresopa'] ?? 'N/A',
                $validatedData['scorememorama'] ?? 'N/A',
            ];
        }

        // Limpiar el archivo CSV antes de reescribir
        ftruncate($file, 0);
        rewind($file);
        fputcsv($file, $header); // Escribir el encabezado

        // Escribir las filas actualizadas de nuevo en el archivo
        foreach ($rows as $row) {
            fputcsv($file, $row);
        }

        // Liberar el bloqueo
        flock($file, LOCK_UN);
    } else {
        return response()->json(['error' => 'No se pudo acceder al archivo para guardar los resultados.'], 500);
    }

    fclose($file);

    // Respuesta exitosa
    return response()->json(['message' => 'Resultados guardados correctamente.', 'player_id' => $playerId]);
}

    }        