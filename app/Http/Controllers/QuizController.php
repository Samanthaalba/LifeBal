<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class QuizController extends Controller
{
    public function show()
    {
        $questions = Question::all(); // Obtén todas las preguntas
        return view('/juegos/quiz', compact('questions')); // Muestra la vista con las preguntas
    }

    public function process(Request $request)
{
    $answers = $request->input('answers'); // Recoge las respuestas enviadas
    $score = 0;

    foreach ($answers as $questionId => $answerGiven) {
        $question = Question::find($questionId);

        if ($question && $question->correct_answer == $answerGiven) {
            $score++;
        }
    }

    // Redirige al usuario con un mensaje flash que contiene el puntaje
    return redirect()->route('quiz.show')->with('score', "Tu puntaje es: {$score}/" . count($answers));
    }
}


