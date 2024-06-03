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
            'score' => 'required|integer',
            'time' => 'required|integer',
            'user_name' => 'required|string|max:255', // Validar el nombre del usuario
        ]);

        GameResult::create($validatedData);

        return response()->json(['message' => 'Result saved successfully']);
    }

    public function saveTotalResult(Request $request)
    {
        $validatedData = $request->validate([
            'game_name' => 'required|string|max:255',
            'score' => 'required|integer',
            'time' => 'required|integer',
            'user_name' => 'required|string|max:255',
        ]);

        GameResult::create($validatedData);

        return response()->json(['message' => 'Total result saved successfully']);
    }
}
