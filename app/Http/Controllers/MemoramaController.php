<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GameResult;

class MemoramaController extends Controller
{
    public function show()
    {
        $items = [
            ['id' => 1, 'type' => 'image', 'content' => 'preservativo-mujer.jpg'],
            ['id' => 1, 'type' => 'description', 'content' => 'Preservativo Mujer'],
            ['id' => 2, 'type' => 'image', 'content' => 'preservativo-hombre.jpg'],
            ['id' => 2, 'type' => 'description', 'content' => 'Preservativo Hombre'],
            ['id' => 3, 'type' => 'image', 'content' => 'anticonceptivos-inyectables.jpg'],
            ['id' => 3, 'type' => 'description', 'content' => 'Anticonceptivos inyectables'],
            ['id' => 4, 'type' => 'image', 'content' => 'pastillas-combinadas.jpg'],
            ['id' => 4, 'type' => 'description', 'content' => 'Pastillas combinadas'],
            ['id' => 5, 'type' => 'image', 'content' => 'pastilla-de-emergencia-(AHE).jpg'],
            ['id' => 5, 'type' => 'description', 'content' => 'Pastilla de Emergencia (AHE)'],
            ['id' => 6, 'type' => 'image', 'content' => 'dispositivo-intrauterino-(DIU).jpg'],
            ['id' => 6, 'type' => 'description', 'content' => 'Dispositivo Intrauterino (DIU)'],
            ['id' => 7, 'type' => 'image', 'content' => 'parche.jpg'],
            ['id' => 7, 'type' => 'description', 'content' => 'Parche'],
            ['id' => 8, 'type' => 'image', 'content' => 'implante-subdermico.jpg'],
            ['id' => 8, 'type' => 'description', 'content' => 'Implante Subdérmico'],
            ['id' => 9, 'type' => 'image', 'content' => 'ligadura-tubaria.jpg'],
            ['id' => 9, 'type' => 'description', 'content' => 'Ligadura Tubaria'],
        ];
        shuffle($items);
        return view('juegos.memorama', compact('items'));
    }

    public function saveResult(Request $request)
    {
        $validatedData = $request->validate([
            'game_name' => 'required|string|max:255',
            'score' => 'required|integer',
            'time' => 'required|integer',
            'user_name' => 'required|string|max:255',
        ]);

        GameResult::create($validatedData);

        return response()->json(['message' => 'Result saved successfully']);
    }
}
