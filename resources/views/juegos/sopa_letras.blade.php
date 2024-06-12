<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>LifeBal</title>
    <style>
        body {
            background-color: #f5daa0; 
        }

        
        .watchVideo {
        position: relative;
        width: 130px;
        height: 35px;
        border-radius: 30px;
        background-color: white;
        border: 1px #cd201f solid;
        overflow: hidden;
        }

        .watchVideo .text1 {
        font-size: 15px;
        font-weight: 600;
        margin-left: 22%;
        }

        .watchVideo .text2 {
        position: absolute;
        top: 25%;
        left: -50px;
        font-weight: 700;
        font-size: 14px;
        color: white;
        }

        .watchVideo .icon {
        position: absolute;
        top: 0;
        left: 0;
        transition: transform 0.5s;
        }

        .watchVideo .icon::before {
        position: absolute;
        left: -100px;
        top: 0;
        z-index: -1;
        content: '';
        width: 130px;
        height: 33px;
        border-radius: 30px;
        background-color: #cd201f;
        }

        .watchVideo:hover .icon {
        transform: translateX(96px);
        transition: transform 0.5s;
        }

        .watchVideo:hover .text2 {
        transform: translateX(100px);
        transition: transform 0.6s;
        }

        .watchVideo:active {
        transform: scale(1.03);
        }

        

    </style>
</head>
<body>
    <div class="background">
        <img class="doc" src="/img/sopa_letras.jpg" alt="">
        <div class="overlay"></div>
    </div>

    <a href="{{asset('/inicio')}}"><button id="backButton">Regresar</button></a>
    <div id="scorePanelSp"> 
        <p>Intentos: <span id="attempts">0</span></p>
        <p>Puntos: <span id="score">0</span></p>
        <p>Tiempo: <span id="timer">00:00</span></p>
    </div>
    <button onclick="refreshpage()" class="otravezsopa button">
        <svg class="svg-icon" fill="none" height="20" viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg"><g stroke="#ff342b" stroke-linecap="round" stroke-width="1.5"><path d="m3.33337 10.8333c0 3.6819 2.98477 6.6667 6.66663 6.6667 3.682 0 6.6667-2.9848 6.6667-6.6667 0-3.68188-2.9847-6.66664-6.6667-6.66664-1.29938 0-2.51191.37174-3.5371 1.01468"></path><path d="m7.69867 1.58163-1.44987 3.28435c-.18587.42104.00478.91303.42582 1.0989l3.28438 1.44986"></path></g></svg>
        <span class="lable">Repetir</span>
    </button>    
    <br>
    <button id="startButton1">Iniciar Juego</button>
    <span class="encontrar">Palabras Por Encontrar</span>
    <div id="contenedor-principal" style="display: flex;"> 
        <div id="sopa-de-letras">
            @foreach ($matriz as $fila)
                <div class="fila">
                    @foreach ($fila as $letra)
                        <span class="letra">{{ $letra }}</span>
                    @endforeach
                </div>
            @endforeach
        </div>
        <div id="lista-palabras">
            <ul>
                <li id="palabra-cuidado" class="palabra">CUIDADO</li>
                <li id="palabra-adolescencia" class="palabra">ADOLESCENCIA</li>
                <li id="palabra-familia" class="palabra">FAMILIA</li>
                <li id="palabra-enfermedades" class="palabra">ENFERMEDADES</li>
                <li id="palabra-orientacion" class="palabra">ORIENTACION</li>
                <li id="palabra-embarazo" class="palabra">EMBARAZO</li>
                <li id="palabra-anticonceptivo" class="palabra">ANTICONCEPTIVO</li>
                <li id="palabra-educacion" class="palabra">EDUCACION</li>
                <li id="palabra-salud" class="palabra">SALUD</li>
                <li id="palabra-prevencion" class="palabra">PREVENCION</li>
                <li id="palabra-sexualidad" class="palabra">SEXUALIDAD</li>
                <li id="palabra-responsabilidad" class="palabra">RESPONSABILIDAD</li>
                <li id="palabra-informacion" class="palabra">INFORMACION</li>
                <li id="palabra-apoyo" class="palabra">APOYO</li>
                <li id="palabra-respeto" class="palabra">RESPETO</li>
                <li id="palabra-comunicacion" class="palabra">COMUNICACION</li>
            </ul>
        </div>
    </div>

    <div id="instructionsModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Instrucciones</h2>
            <p>El objetivo del juego es encontrar las palabras listadas en el menor tiempo posible:</p>
            <ul>
                <li><strong>Inicio del Juego</strong>: Haz clic en "Iniciar Juego" para comenzar.</li>
                <li><strong>Llenado de la sopa</strong>: Busca las palabras en la lista, estas se marcan automanticamente al encontrarlas.</li>
                <li><strong>Final</strong>:El juego termina cuando encuentres todas las palabras.</li>
                <li><strong>Puntuación</strong>: Los intentos y el puntaje se actualizarán automáticamente.</li>
                <li><strong>¡Para una mejor introducción al tema, mira el siguiente video!</strong></li>
            </ul>
            <button class="watchVideo">
                <a href="https://youtu.be/8GFDYBe2TQY" target="_blank">
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

<button id="viewResultsButton" class="verpuntos">Ver Resultados</button>

    <script src="/js/sopa.js"></script>
    <script>
        function refreshpage(){
        location.reload();
    }
    </script>
</body>
</html>
