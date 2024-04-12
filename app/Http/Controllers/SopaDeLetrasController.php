<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SopaDeLetrasController extends Controller
{
    public function index()
    {
        $palabras = [
            'ANTICONCEPTIVO', 'RESPONSABILIDAD', 'TRICOMONIASIS', 'CANDIDIASIS',
            'EDUCACION', 'SEXUALIDAD', 'PREVENCION', 'INFORMACION', 'CLAMIDIA',
            'GONORREA', 'SIFILIS', 'HERPES', 'HEPATITIS', 'URETRITIS', 'CHANCRO',
            'BALANITIS', 'CONDILOMA', 'EMBARAZO', 'SALUD', 'APOYO', 'RESPETO',
            'ULCERA', 'VPH', 'HIV', 'VIH', 'SIDA', 'LUES', 'MOLUSCO', 'PUBIS'

        ];
    
        // Asegúrate de que las palabras estén en mayúsculas para coincidir con la generación y verificación
        $palabras = array_map('strtoupper', $palabras);
    
        $matriz = $this->generarSopaDeLetras($palabras);
    
        // Pasa tanto la matriz como las palabras a la vista
        return view('/juegos/sopa_letras', compact('matriz', 'palabras'));
    }
    

    private function generarSopaDeLetras($palabras)
    {
        $tamano = 15;
        $matriz = array_fill(0, $tamano, array_fill(0, $tamano, '_'));

        foreach ($palabras as $palabra) {
            $colocada = false;
            $intentos = 0;
            while (!$colocada && $intentos < 100) { // Limita los intentos para evitar bucles infinitos
                $direccion = rand(0, 2); // 0: horizontal, 1: vertical, 2: diagonal
                $fila = rand(0, $tamano - 1);
                $col = rand(0, $tamano - 1);

                if ($this->puedeColocarPalabra($matriz, $palabra, $fila, $col, $direccion)) {
                    $this->colocarPalabra($matriz, $palabra, $fila, $col, $direccion);
                    $colocada = true;
                }

                $intentos++;
            }
        }

        $this->rellenarEspaciosVacios($matriz);

        return $matriz;
    }

    private function puedeColocarPalabra(&$matriz, $palabra, $fila, $col, $direccion)
{
    $longitud = strlen($palabra);
    $tamano = count($matriz);

    for ($i = 0; $i < $longitud; $i++) {
        // Calcula la posición actual basada en la dirección
        $posFila = $fila + ($direccion == 1 || $direccion == 2 ? $i : 0);
        $posCol = $col + ($direccion == 0 || $direccion == 2 ? $i : 0);

        // Verifica si la posición actual está fuera de los límites de la matriz
        if ($posFila >= $tamano || $posCol >= $tamano|| $posFila < 0 || $posCol < 0) {
            return false;
        }

        // Verifica solapamiento con otras palabras
        if ($matriz[$posFila][$posCol] !== '_' && $matriz[$posFila][$posCol] !== $palabra[$i]) {
            return false;
        }
    }

    return true; // La palabra se puede colocar
}


private function colocarPalabra(&$matriz, $palabra, $fila, $col, $direccion)
{
    $palabra = strtoupper($palabra); // Asegura que la palabra esté en mayúsculas
    $longitud = strlen($palabra);
    for ($i = 0; $i < $longitud; $i++) {
        switch ($direccion) {
            case 0: // Horizontal
                $matriz[$fila][$col + $i] = $palabra[$i];
                break;
            case 1: // Vertical
                $matriz[$fila + $i][$col] = $palabra[$i];
                break;
            case 2: // Diagonal
                $matriz[$fila + $i][$col + $i] = $palabra[$i];
                break;
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

}
