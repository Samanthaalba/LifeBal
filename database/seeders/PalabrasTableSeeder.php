<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Palabra;

class PalabrasTableSeeder extends Seeder
{
    public function run()
    {
        $palabras = [
            // Palabras horizontales
            ['palabra' => 'Sífilis', 'pista' => ': Infección bacteriana de transmisión sexual que se caracteriza por una serie de etapas que incluyen la formación de una llaga indolora en el sitio de la infección inicial, seguida de una erupción cutánea en el cuerpo. Si no se trata, puede causar daño a los órganos internos.', 'direccion' => 'horizontal', 'posicion_x' => 1, 'posicion_y' => 1],
            ['palabra' => 'Clamidia', 'pista' => ': Infección bacteriana común de transmisión sexual causada por la bacteria Chlamydia trachomatis. A menudo es asintomática, pero puede provocar dolor al orinar, secreción y dolor abdominal en mujeres.', 'direccion' => 'horizontal', 'posicion_x' => 2, 'posicion_y' => 3],
            ['palabra' => 'Papiloma', 'pista' => ': Infección viral transmitida principalmente por contacto sexual, que puede provocar el desarrollo de protuberancias o verrugas en la piel y membranas mucosas, especialmente en los genitales, boca y garganta. Algunos tipos de este virus están relacionados con un mayor riesgo de cáncer, incluyendo el cervical y anal.', 'direccion' => 'horizontal', 'posicion_x' => 3, 'posicion_y' => 5],
            ['palabra' => 'Candidiasis', 'pista' => 'Infección fúngica que puede afectar muchas partes del cuerpo.', 'direccion' => 'horizontal', 'posicion_x' => 4, 'posicion_y' => 7],
            ['palabra' => 'Hepatitis', 'pista' => 'Condición médica que involucra la inflamación del hígado, la cual puede ser causada por diversos factores como infecciones virales, consumo excesivo de alcohol, o enfermedades autoinmunes. Los síntomas comunes incluyen fatiga, ictericia (coloración amarillenta de la piel y los ojos), dolor abdominal, náuseas y pérdida de apetito. Esta afección puede tener consecuencias graves si no se trata adecuadamente.', 'direccion' => 'horizontal', 'posicion_x' => 5, 'posicion_y' => 9],
            ['palabra' => 'Herpes', 'pista' => ': Infección viral causada por VHS. Caracterizada por la aparición de ampollas dolorosas en la piel y membranas mucosas, principalmente alrededor de los genitales y la boca. Esta infección puede manifestarse en forma de brotes recurrentes, con síntomas como picazón, sensación de ardor y malestar general.', 'direccion' => 'horizontal', 'posicion_x' => 6, 'posicion_y' => 11],
            ['palabra' => 'VIH', 'pista' => 'Virus que ataca el sistema inmunológico del cuerpo, dejándolo vulnerable a diversas infecciones y enfermedades. Esta infección viral puede transmitirse principalmente a través de relaciones sexuales sin protección, contacto con sangre contaminada o de madre a hijo durante el parto o la lactancia. Si no se trata, puede progresar a una etapa más avanzada conocida como SIDA.', 'direccion' => 'horizontal', 'posicion_x' => 7, 'posicion_y' => 13],

            // Palabras verticales
            ['palabra' => 'SIDA', 'pista' => 'Es la etapa avanzada de la infección por VIH. En esta etapa avanzada de la infección, el sistema inmunológico está gravemente debilitado, lo que hace que el cuerpo sea vulnerable a diversas infecciones oportunistas y ciertos tipos de cáncer. Esta condición puede ser fatal si no se trata adecuadamente.', 'direccion' => 'vertical', 'posicion_x' => 1, 'posicion_y' => 2],
            ['palabra' => 'Gonorrea', 'pista' => 'Infección bacteriana causada por la bacteria Neisseria gonorrhoeae. Esta infección puede afectar los genitales, el recto y la garganta. Los síntomas pueden incluir dolor al orinar, secreción uretral o vaginal, y en algunos casos dolor abdominal. Es importante tratarla adecuadamente para evitar complicaciones como la enfermedad inflamatoria pélvica y la infertilidad.', 'direccion' => 'vertical', 'posicion_x' => 3, 'posicion_y' => 2],
            ['palabra' => 'Úlcera', 'pista' => 'Lesión abierta en la piel o membrana mucosa que puede ocurrir en los genitales como resultado de una infección de transmisión sexual, como la sífilis o el herpes.', 'direccion' => 'vertical', 'posicion_x' => 5, 'posicion_y' => 4],
            ['palabra' => 'VPH', 'pista' => 'Virus de transmisión sexual que afecta la piel y las membranas mucosas, incluidos los genitales y el área anal. Algunos tipos de este virus pueden causar verrugas genitales, mientras que otros están asociados con un mayor riesgo de desarrollar cáncer cervical, anal, de garganta y otros tipos de cáncer. Es una infección muy común y puede transmitirse a través del contacto sexual directo.', 'direccion' => 'vertical', 'posicion_x' => 7, 'posicion_y' => 4],
            ['palabra' => 'Uretritis', 'pista' => ': Inflamación de la uretra, el conducto que transporta la orina desde la vejiga hacia el exterior del cuerpo. Esta inflamación puede ser causada por infecciones bacterianas, víricas o fúngicas, así como por irritación debido a sustancias químicas o lesiones. Los síntomas comunes incluyen dolor o ardor al orinar, necesidad frecuente de orinar, y en algunos casos, secreción uretral.', 'direccion' => 'vertical', 'posicion_x' => 9, 'posicion_y' => 6],
            ['palabra' => 'Condiloma', 'pista' => ': También conocido como verrugas genitales, son crecimientos de la piel causados por ciertos tipos de VPH. Estas verrugas pueden ser pequeñas, planas o tener una apariencia similar a la coliflor.  ', 'direccion' => 'vertical', 'posicion_x' => 11, 'posicion_y' => 6],
            ['palabra' => 'Pubis', 'pista' => ': La región del cuerpo donde se encuentran los órganos sexuales externos y el vello púbico.', 'direccion' => 'vertical', 'posicion_x' => 13, 'posicion_y' => 8],
        ];

        foreach ($palabras as $palabra) {
            Palabra::create($palabra);
        }
    }
}