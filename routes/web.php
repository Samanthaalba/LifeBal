<?php

use Illuminate\Support\Facades\Route;



//Route::get('/', function () {
   // return view('inicio');
//});

Route::get('/', function () {
    $cards = [
        [
            'title' => 'Memorama',
            'description' => 'Este juego busca que el alumno reconozca los diversos metodos anticonceptivos a traves del emparejamiento del nombre del metodo con la imagen correspondiente.',
            'color' => 'card-red'
        ],
        [
            'title' => 'Quiz',
            'description' => 'Los participantes deben responder correctamente las preguntas para avanzar en el juego, lo que fomenta el aprendizaje y la comprensión de los riesgos de embarazo a temprana edad.',
            'color' => 'card-blue'
        ],
        [
            'title' => 'Serpientes y Escaleras',
            'description' => 'Al avanzar por las escaleras, los jugadores pueden aprender y ser recompensados con una mejor comprensión de la sexualidad responsable.',
            'color' => 'card-green'
        ],
        [
            'title' => 'Sopa de Letras',
            'description' => 'Este juego ayuda a mejorar la capacidad de reconocimiento de vocabulario y refuerza el conocimiento de conceptos clave.',
            'color' => 'card-yellow'
        ],
        [
            'title' => 'Crucigrama',
            'description' => 'Los jugadores deben resolver pistas para encontrar las palabras correctas, lo que refuerza la comprensión de las ETS.',
            'color' => 'card-pink'
        ]
    ];

    return view('inicio', ['cards' => $cards]);
});






