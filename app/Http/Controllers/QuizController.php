<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\GameResult;

class QuizController extends Controller
{
    public function show()
    {
        $questions = Question::all();
        return view('juegos.quiz', ['questions' => $questions]);
    }

    public function process(Request $request)
    {
        $answers = $request->input('answers');
        $score = 0;

        foreach ($answers as $questionId => $answerGiven) {
            $question = Question::find($questionId);

            if ($question && $question->correct_answer == $answerGiven) {
                $score++;
            }
        }

        return redirect()->route('quiz.show')->with('score', "Tu puntaje es: {$score}/" . count($answers));
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
