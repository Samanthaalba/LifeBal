<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\GameResultController;

class CrucigramaController extends Controller
{
    protected $gameResultController;

    public function __construct(GameResultController $gameResultController)
    {
        $this->gameResultController = $gameResultController;
    }

    public function index()
    {
        $palabras = [
            // Palabras horizontales
            ['palabra' => 'Sífilis', 'pista' => '1.Infección bacteriana de transmisión sexual, se caracteriza por etapas como la formación de una llaga indolora y una erupción cutánea en el cuerpo.', 'direccion' => 'horizontal', 'posicion_x' => 1, 'posicion_y' => 1],
            ['palabra' => 'Clamidia', 'pista' => '2.Infección bacteriana común de transmisión sexual causada por la bacteria Chlamydia trachomatis.', 'direccion' => 'horizontal', 'posicion_x' => 2, 'posicion_y' => 3],
            ['palabra' => 'Papiloma', 'pista' => '3.Infección viral transmitida por contacto sexual, provoca el desarrollo de protuberancias o verrugas en la piel, especialmente en los genitales, boca y garganta.', 'direccion' => 'horizontal', 'posicion_x' => 3, 'posicion_y' => 5],
            ['palabra' => 'Candidiasis', 'pista' => '4.Infección fúngica que puede afectar muchas partes del cuerpo.', 'direccion' => 'horizontal', 'posicion_x' => 4, 'posicion_y' => 7],
            ['palabra' => 'Hepatitis', 'pista' => '5.Condición médica que involucra la inflamación del hígado, causada por infecciones virales, consumo excesivo de alcohol, o enfermedades autoinmunes.', 'direccion' => 'horizontal', 'posicion_x' => 5, 'posicion_y' => 9],
            ['palabra' => 'Herpes', 'pista' => '6.Infección viral causada por VHS. Caracterizada por la aparición de ampollas dolorosas en la piel y membranas mucosas, alrededor de los genitales y la boca.', 'direccion' => 'horizontal', 'posicion_x' => 6, 'posicion_y' => 11],
            ['palabra' => 'VIH', 'pista' => '7.Esta infección viral se transmite a través de relaciones sexuales sin protección, contacto con sangre contaminada o de madre a hijo durante el parto o la lactancia. Puede progresar a SIDA.', 'direccion' => 'horizontal', 'posicion_x' => 7, 'posicion_y' => 13],

            // Palabras verticales
            ['palabra' => 'SIDA', 'pista' => '8.Es la etapa avanzada de la infección por VIH.', 'direccion' => 'vertical', 'posicion_x' => 1, 'posicion_y' => 2],
            ['palabra' => 'Gonorrea', 'pista' => '9.Infección bacteriana causada por la bacteria Neisseria gonorrhoeae. Esta infección puede afectar los genitales, el recto y la garganta.', 'direccion' => 'vertical', 'posicion_x' => 3, 'posicion_y' => 2],
            ['palabra' => 'Úlcera', 'pista' => '10.Lesión abierta en la piel puede ocurrir en los genitales como resultado de una infección de transmisión sexual, como la sífilis o el herpes.', 'direccion' => 'vertical', 'posicion_x' => 5, 'posicion_y' => 4],
            ['palabra' => 'VPH', 'pista' => '11.Virus de transmisión sexual que afecta la piel y las membranas mucosas, incluidos los genitales. Algunos tipos de este virus pueden causar verrugas genitales.', 'direccion' => 'vertical', 'posicion_x' => 7, 'posicion_y' => 4],
            ['palabra' => 'Uretritis', 'pista' => '12.Inflamación de la uretra (conducto que transporta la orina). Inflamación causada por infecciones bacterianas, así como por irritación debido a sustancias químicas o lesiones.', 'direccion' => 'vertical', 'posicion_x' => 9, 'posicion_y' => 6],
            ['palabra' => 'Condiloma', 'pista' => '13.También conocido como verrugas genitales, son crecimientos de la piel causados por ciertos tipos de VPH.', 'direccion' => 'vertical', 'posicion_x' => 11, 'posicion_y' => 6],
            ['palabra' => 'Pubis', 'pista' => '14.Es la parte del cuerpo donde se encuentran los órganos sexuales externos y el vello púbico.', 'direccion' => 'vertical', 'posicion_x' => 13, 'posicion_y' => 8],
        ];
        return view('juegos.crucigrama', ['palabras' => $palabras]); 
    }

    public function saveResult(Request $request)
{
    // Validar los datos recibidos
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'scorecrucigrama' => 'required|integer', // Cambiamos a scorecrucigrama
    ]);

    // Log para depuración
    \Log::info('Datos recibidos en saveResult:', $validatedData);

    // Llamar al controlador que maneja el almacenamiento
    return app(GameResultController::class)->storeFinalResult($request);
}


}
