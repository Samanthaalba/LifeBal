<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionsTableSeeder extends Seeder
{
    public function run()
    {
        $questions = [
            [
                'question' => '¿Por qué es importante cuidarse durante la adolescencia para evitar un embarazo?',
                'option_a' => 'Para poder viajar más',
                'option_b' => 'Para seguir estudiando y planear un futuro seguro',
                'option_c' => 'Para tener más tiempo de jugar videojuegos',
                'option_d' => 'No es importante',
                'correct_answer' => 'B',
            ],
            [
                'question' => 'Si una adolescente queda embarazada, ¿qué puede pasar con sus estudios?',
                'option_a' => 'Puede graduarse más rápido',
                'option_b' => 'Puede ser más difícil terminar la escuela',
                'option_c' => 'Los maestros le darán menos tarea',
                'option_d' => 'Recibirá un premio por asistencia',
                'correct_answer' => 'B',
            ],
            [
                'question' => '¿Cómo puede afectar emocionalmente el embarazo a una adolescente?',
                'option_a' => 'La hace mejor en deportes',
                'option_b' => 'Puede sentirse más estresada y preocupada',
                'option_c' => 'No afecta en nada',
                'option_d' => 'La hace más popular en la escuela',
                'correct_answer' => 'B',
            ],
            [
                'question' => '¿Cuál es un posible riesgo para el bebé de una mamá adolescente?',
                'option_a' => 'Tener superpoderes',
                'option_b' => 'Ser un genio en matemáticas',
                'option_c' => 'Nacer más pequeño de lo normal',
                'option_d' => 'Nada, es igual que cualquier bebé',
                'correct_answer' => 'C',
            ],
            [
                'question' => '¿Por qué el apoyo de amigos y familia es importante para una adolescente embarazada?',
                'option_a' => 'Para tener a quién contarle chismes',
                'option_b' => 'Ayuda a sentirse acompañada y apoyada',
                'option_c' => 'Porque le pueden prestar videojuegos',
                'option_d' => 'No es importante el apoyo',
                'correct_answer' => 'B',
            ],
            [
                'question' => '¿Qué puede pasar si no se recibe atención médica durante el embarazo?',
                'option_a' => 'Se puede ganar un concurso',
                'option_b' => 'Aumentan los riesgos para la mamá y el bebé',
                'option_c' => 'Nada, todo sigue igual',
                'option_d' => 'La atención médica es solo para adultos',
                'correct_answer' => 'B',
            ],
            [
                'question' => '¿El embarazo adolescente cómo afecta las amistades?',
                'option_a' => 'Las hace más fuertes siempre',
                'option_b' => 'Puede ser más complicado mantener algunas amistades',
                'option_c' => 'Te hace más popular',
                'option_d' => 'No afecta en nada',
                'correct_answer' => 'B',
            ],
            [
                'question' => '¿Qué desafío económico enfrentan comúnmente las mamás adolescentes?',
                'option_a' => 'Tienen demasiado dinero para gastar',
                'option_b' => 'Puede ser difícil tener suficiente dinero para cuidar al bebé',
                'option_c' => 'No hay ningún desafío económico',
                'option_d' => 'Ganan más dinero',
                'correct_answer' => 'B',
            ],
            [
                'question' => 'En términos de salud emocional, ¿qué impacto puede tener un embarazo adolescente?',
                'option_a' => 'Siempre mejora el humor',
                'option_b' => 'Puede causar estrés y preocupaciones adicionales',
                'option_c' => 'No tiene ningún efecto emocional',
                'option_d' => 'Hace que la adolescencia sea más fácil',
                'correct_answer' => 'B',
            ],
            [
                'question' => '¿Por qué es importante aprender sobre salud sexual y anticoncepción?',
                'option_a' => 'Para ser experto en biología',
                'option_b' => 'Para tomar decisiones informadas sobre tu cuerpo y futuro',
                'option_c' => 'Solo es importante para adultos',
                'option_d' => 'No es importante aprender sobre eso',
                'correct_answer' => 'B',
            ],
        ];

        DB::table('questions')->insert($questions);
    }
}
