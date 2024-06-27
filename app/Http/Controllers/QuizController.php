<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GameResult;

class QuizController extends Controller
{
    public function show()
    {
        $questions = [
            [
                'id' => 1,
                'question' => '¿Por qué es importante cuidarse durante la adolescencia para evitar un embarazo?',
                'option_a' => 'Para poder viajar más',
                'option_b' => 'Para seguir estudiando y planear un futuro seguro',
                'option_c' => 'Para tener más tiempo de jugar videojuegos',
                'option_d' => 'No es importante',
                'correct_answer' => 'B',
            ],
            [
                'id' => 2,
                'question' => 'Si una adolescente queda embarazada, ¿qué puede pasar con sus estudios?',
                'option_a' => 'Puede graduarse más rápido',
                'option_b' => 'Puede ser más difícil terminar la escuela',
                'option_c' => 'Los maestros le darán menos tarea',
                'option_d' => 'Recibirá un premio por asistencia',
                'correct_answer' => 'B',
            ],
            [
                'id' => 3,
                'question' => '¿Cómo puede afectar emocionalmente el embarazo a una adolescente?',
                'option_a' => 'La hace mejor en deportes',
                'option_b' => 'Puede sentirse más estresada y preocupada',
                'option_c' => 'No afecta en nada',
                'option_d' => 'La hace más popular en la escuela',
                'correct_answer' => 'B',
            ],
            [
                'id' => 4,
                'question' => '¿Cuál es un posible riesgo para el bebé de una mamá adolescente?',
                'option_a' => 'Tener superpoderes',
                'option_b' => 'Ser un genio en matemáticas',
                'option_c' => 'Nacer más pequeño de lo normal',
                'option_d' => 'Nada, es igual que cualquier bebé',
                'correct_answer' => 'C',
            ],
            [
                'id' => 5,
                'question' => '¿Por qué el apoyo de amigos y familia es importante para una adolescente embarazada?',
                'option_a' => 'Para tener a quién contarle chismes',
                'option_b' => 'Ayuda a sentirse acompañada y apoyada',
                'option_c' => 'Porque le pueden prestar videojuegos',
                'option_d' => 'No es importante el apoyo',
                'correct_answer' => 'B',
            ],
            [
                'id' => 6,
                'question' => '¿Qué puede pasar si no se recibe atención médica durante el embarazo?',
                'option_a' => 'Se puede ganar un concurso',
                'option_b' => 'Aumentan los riesgos para la mamá y el bebé',
                'option_c' => 'Nada, todo sigue igual',
                'option_d' => 'La atención médica es solo para adultos',
                'correct_answer' => 'B',
            ],
            [
                'id' => 7,
                'question' => '¿El embarazo adolescente cómo afecta las amistades?',
                'option_a' => 'Las hace más fuertes siempre',
                'option_b' => 'Puede ser más complicado mantener algunas amistades',
                'option_c' => 'Te hace más popular',
                'option_d' => 'No afecta en nada',
                'correct_answer' => 'B',
            ],
            [
                'id' => 8,
                'question' => '¿Qué desafío económico enfrentan comúnmente las mamás adolescentes?',
                'option_a' => 'Tienen demasiado dinero para gastar',
                'option_b' => 'Puede ser difícil tener suficiente dinero para cuidar al bebé',
                'option_c' => 'No hay ningún desafío económico',
                'option_d' => 'Ganan más dinero',
                'correct_answer' => 'B',
            ],
            [
                'id' => 9,
                'question' => 'En términos de salud emocional, ¿qué impacto puede tener un embarazo adolescente?',
                'option_a' => 'Siempre mejora el humor',
                'option_b' => 'Puede causar estrés y preocupaciones adicionales',
                'option_c' => 'No tiene ningún efecto emocional',
                'option_d' => 'Hace que la adolescencia sea más fácil',
                'correct_answer' => 'B',
            ],
            [
                'id' => 10,
                'question' => '¿Por qué es importante aprender sobre salud sexual y anticoncepción?',
                'option_a' => 'Para ser experto en biología',
                'option_b' => 'Para tomar decisiones informadas sobre tu cuerpo y futuro',
                'option_c' => 'Solo es importante para adultos',
                'option_d' => 'No es importante aprender sobre eso',
                'correct_answer' => 'B',
            ],
        ];

        return view('juegos.quiz', ['questions' => $questions]);
    }

    public function process(Request $request)
    {
        $answers = $request->input('answers');
        $score = 0;

        $questions = [
            1 => 'B', 2 => 'B', 3 => 'B', 4 => 'C', 5 => 'B',
            6 => 'B', 7 => 'B', 8 => 'B', 9 => 'B', 10 => 'B'
        ];

        foreach ($answers as $questionId => $answerGiven) {
            if (isset($questions[$questionId]) && $questions[$questionId] == $answerGiven) {
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
