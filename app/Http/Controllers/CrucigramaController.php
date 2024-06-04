<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Palabra;
use App\Models\GameResult;

class CrucigramaController extends Controller
{
    public function index()
    {
        $palabras = Palabra::all();
        return view('juegos.crucigrama', compact('palabras'));
    }

    public function saveResult(Request $request)
    {
        $validatedData = $request->validate([
            'game_name' => 'required|string|max:255',
            'total_score' => 'required|integer',
            'total_time' => 'required|integer',
            'user_name' => 'required|string|max:255',
        ]);

        // Log para depuración
        \Log::info('Datos recibidos en saveResult:', $validatedData);

        GameResult::create($validatedData);

        return response()->json(['message' => 'Result saved successfully']);
    }
}
