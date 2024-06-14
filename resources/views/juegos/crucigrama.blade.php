<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LifeBal</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <style>
        body {
            background-color: #f5daa0; 
        }

    </style>
</head>
<body class="crusi">
<div class="background">
  <img class="doc" src="/img/crusi.jpg" alt="">
  <div class="overlay"></div>
</div>
<a href="/inicio">
    <button id="backButton" class="cta">
      <svg width="15px" height="10px" viewBox="0 0 13 10">
        <path d="M12,5 L2,5"></path> 
        <polyline points="5 1 1 5 5 9"></polyline>
      </svg>
      <span>Regresar</span>
    </button>
  </a>

<button onclick="refreshpage()" class="otravezcruci button">
    <svg class="svg-icon" fill="none" height="20" viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg"><g stroke="#ff342b" stroke-linecap="round" stroke-width="1.5"><path d="m3.33337 10.8333c0 3.6819 2.98477 6.6667 6.66663 6.6667 3.682 0 6.6667-2.9848 6.6667-6.6667 0-3.68188-2.9847-6.66664-6.6667-6.66664-1.29938 0-2.51191.37174-3.5371 1.01468"></path><path d="m7.69867 1.58163-1.44987 3.28435c-.18587.42104.00478.91303.42582 1.0989l3.28438 1.44986"></path></g></svg>
    <span class="lable">Repetir</span>
  </button>

<div class="puntuacion"> 
    <p>Intentos: <span id="attempts">0</span></p>
    <p>Puntos: <span id="score">0</span></p>
    <p>Tiempo: <span id="timer">00:00</span></p>
</div>

<br>
<table id="crucigrama-grid"></table>
<button id="IniciarC" onclick="iniciarJuego()">Iniciar Juego</button>
<button id="pistaButton">Pistas</button>

<div class="PalabrasC">
    <ul id="pistaList" style="display: none;">
        @foreach($palabras as $palabra)
            @if($palabra->direccion == 'horizontal')
                <li>{{ $palabra->palabra }}</li>
            @endif
        @endforeach
        @foreach($palabras as $palabra)
            @if($palabra->direccion == 'vertical')
                <li>{{ $palabra->palabra }}</li>
            @endif
        @endforeach
    </ul>
</div>
<div class="crucigrama-container">
    <div class="pistas-container">
        <div class="pistas">
            <h2>Horizontales</h2>
            <ul class="palabras-lista">
                @foreach($palabras as $palabra)
                    @if($palabra->direccion == 'horizontal')
                        <li>{{ $palabra->id }} {{ $palabra->pista }}</li>
                    @endif
                @endforeach
            </ul>
        </div>
        <div class="pistas">
            <h2>Verticales</h2>
            <ul class="palabras-lista">
                @foreach($palabras as $palabra)
                    @if($palabra->direccion == 'vertical')
                        <li>{{ $palabra->id }} {{ $palabra->pista }}</li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</div>

<div id="instructionsModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Instrucciones</h2>
        <p>El objetivo del juego es encontrar las palabras correspondiendes según la descripción y ubicarlas correctamente:</p>
        <ul>
            <li><strong>Inicio del Juego</strong>: Presiona el botón "Iniciar Juego" para comenzar el crucigrama.</li>
            <li><strong>Pistas</strong>: Usa "Pista" para ver una pista por 10 segundos.</li>
            <li><strong>Llenado del Crucigrama</strong>: Haz clic en las celdas del crucigrama para ingresar tus respuestas.</li>
            <li><strong>Puntuación</strong>: Los intentos y el puntaje se actualizarán automáticamente.</li>
            <li><strong>Verticales y Horizontales</strong>: Las descripciones están en la parte inferior.</li>
            <li><strong>¡Para una mejor introducción al tema, mira el siguiente video!</strong></li>
        </ul>
        <button class="watchVideo1">
            <a href="https://youtu.be/1gbF4MjoOPE?si=NpX4JEQr18L6Xj-q" target="_blank">
                <span class="icon">
                  <svg fill="none" height="33" viewBox="0 0 120 120" width="33" xmlns="http://www.w3.org/2000/svg">
                    <path d="m120 60c0 33.1371-26.8629 60-60 60s-60-26.8629-60-60 26.8629-60 60-60 60 26.8629 60 60z" fill="#cd201f"></path>
                    <path d="m25 49c0-7.732 6.268-14 14-14h42c7.732 0 14 6.268 14 14v22c0 7.732-6.268 14-14 14h-42c-7.732 0-14-6.268-14-14z" fill="#fff"></path>
                    <path d="m74 59.5-21 10.8253v-21.6506z" fill="#cd201f"></path>
                  </svg>
                </span>
                <span class="text1">Ver Video</span>
              </a>
            </button>
            <br>
        <button id="closeInstructions">Cerrar</button>
    </div>
</div>

<!-- Modal de resultados -->
<div id="resultsModal" class="modal1">
    <div class="modal-content1">
        <span id="closeResultsModal" class="close1">&times;</span>
        <h2>Resultados Anteriores</h2>
        <ul id="results-list"></ul>
    </div>
</div>

<button id="viewResultsButton" class="verpuntoscruci"><strong>Puntuación Record</strong></button>

<!-- Modal de prevención -->
<div id="preventionModal" class="modal-prevention">
    <div class="modal-content-prevention">
        <span class="close-prevention">&times;</span>
        <h2>¡Hola Jugadores!</h2>
        <p>¡Felicidades por completar el crucigrama! Recuerda que la prevención de enfermedades es fundamental. Aquí algunos consejos:</p>
        <ul class="ul">
            <li class="li">Vacúnate regularmente.</li>
            <li class="li">Mantén una higiene adecuada.</li>
            <li class="li">Acércate con un adulto de cofianza.</li>
            <li class="li">No estas solo/a.</li>
            <li class="li">Usa protección durante las relaciones sexuales.</li>
            <li class="li">Realiza chequeos médicos periódicos.</li>
            <li class="li">Mantén un estilo de vida saludable con una dieta equilibrada y ejercicio regular.</li>
        </ul>
    </div>
</div>

<script src="{{ asset('js/crusigrama.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var pistaButton = document.getElementById('pistaButton');
        var pistaList = document.getElementById('pistaList');

        pistaButton.addEventListener('click', function () {
            pistaList.style.display = 'block';

            setTimeout(function () {
                pistaList.style.display = 'none';
            }, 10000);
        });
    });

    function refreshpage(){
        location.reload();
    }
</script>
</body>
</html>
