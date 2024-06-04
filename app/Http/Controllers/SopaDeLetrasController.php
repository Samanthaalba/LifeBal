<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GameResult;

class SopaDeLetrasController extends Controller
{
    public function index()
    {
        $palabras = [
            'CUIDADO', 'ADOLESCENCIA', 'FAMILIA', 'ENFERMEDADES', 'ORIENTACION', 'EMBARAZO', 
            'ANTICONCEPTIVO', 'EDUCACION', 'SALUD','PREVENCION', 'SEXUALIDAD', 'RESPONSABILIDAD', 
            'INFORMACION', 'APOYO', 'RESPETO','COMUNICACION'
        ];
    
        // Asegúrar de que las palabras estén en mayúsculas para coincidir con la generación y verificación
        $palabras = array_map('strtoupper', $palabras);
    
        $matriz = $this->generarSopaDeLetras($palabras);
    
        // Pasa tanto la matriz como las palabras a la vista
        return view('juegos.sopa_letras', compact('matriz', 'palabras'));
    }

    private function generarSopaDeLetras($palabras)
    {
        $tamano = 19;
        $matriz = array_fill(0, $tamano, array_fill(0, $tamano, '_'));

        $repetitions = array(); // Contador de repeticiones de cada palabra
        foreach ($palabras as $palabra) {
            $repetitions[$palabra] = 0;
        }

        foreach ($palabras as $palabra) {
            $colocada = false;
            $intentos = 0;
            while (!$colocada && $intentos < 200) { // Limita los intentos para evitar bucles infinitos
                $direccion = rand(0, 1); // 0: horizontal, 1: vertical
                $fila = rand(0, $tamano - 1);
                $col = rand(0, $tamano - 1);

                if ($this->puedeColocarPalabra($matriz, $palabra, $fila, $col, $direccion, $tamano)
                    && $repetitions[$palabra] < 3) { // Limita a 3 repeticiones por palabra
                    $this->colocarPalabra($matriz, $palabra, $fila, $col, $direccion);
                    $colocada = true;
                    $repetitions[$palabra]++;
                }

                $intentos++;
            }
        }

        $this->rellenarEspaciosVacios($matriz);

        return $matriz;
    }

    private function puedeColocarPalabra(&$matriz, $palabra, $fila, $col, $direccion, $tamano)
    {
        $longitud = strlen($palabra);

        for ($i = 0; $i < $longitud; $i++) {
            if ($direccion == 0 && ($col + $i >= $tamano || $matriz[$fila][$col + $i] != '_')) {
                return false; // No se puede colocar horizontalmente
            }
            if ($direccion == 1 && ($fila + $i >= $tamano || $matriz[$fila + $i][$col] != '_')) {
                return false; // No se puede colocar verticalmente
            }
        }

        return true; // La palabra se puede colocar
    }

    private function colocarPalabra(&$matriz, $palabra, $fila, $col, $direccion)
    {
        $palabra = strtoupper($palabra); // Asegura que la palabra esté en mayúsculas
        $longitud = strlen($palabra);
        for ($i = 0; $i < $longitud; $i++) {
            if ($direccion == 0) {
                $matriz[$fila][$col + $i] = $palabra[$i]; // Horizontal
            } else {
                $matriz[$fila + $i][$col] = $palabra[$i]; // Vertical
            }
        }
    }

    private function rellenarEspaciosVacios(&$matriz)
    {
        for ($i = 0; $i < count($matriz); $i++) {
            for ($j = 0; $j < count($matriz[$i]); $j++) {
                if ($matriz[$i][$j] === '_') {
                    $matriz[$i][$j] = chr(rand(65, 90)); // Genera una letra aleatoria A-Z en mayúsculas
                }
            }
        }
    }
    public function saveResult(Request $request)
    {
        $validatedData = $request->validate([
            'game_name' => 'required|string|max:255',
            'score' => 'required|integer',
            'time' => 'required|integer',
        ]);

        GameResult::create($validatedData);

        return response()->json(['message' => 'Result saved successfully']);
    }
}