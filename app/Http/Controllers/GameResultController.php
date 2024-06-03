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

        try {
            // Crear un nuevo resultado de juego
            $result = GameResult::create([
                'user_name' => $validatedData['user_name'],
                'total_time' => $validatedData['total_time'],
                'total_score' => $validatedData['total_score'],
            ]);

            return response()->json([
                'message' => 'Resultados almacenados con éxito',
                'result' => $result,
            ]);
        } catch (\Exception $e) {
            // Manejo de errores
            return response()->json([
                'message' => 'Error al almacenar los resultados',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
