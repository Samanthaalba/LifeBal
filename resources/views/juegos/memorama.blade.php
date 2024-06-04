<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LifeBal</title>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            background-color: #f5daa0; 
        }
    </style>
</head>
<body>
<div class="background">
  <img class="doc" src="/img/memo.jpg" alt="">
  <div class="overlay"></div>
</div>
    <a href="/inicio"><button id="backButton">Regresar</button></a>
    <div class="container">
        <div id="gameControls">
            <button id="startButton">Iniciar Juego</button>
            <button id="viewResultsButton">Ver Resultados</button>
        </div>  
        <div id="scorePanel">
            <p>Intentos: <span id="attempts">0</span></p>
            <p>Puntos: <span id="score">0</span></p>
            <p>Tiempo: <span id="timer">00:00</span></p>
        </div>
        
        <div id="gameBoard">
            @foreach ($items as $item)
            <div class="card" data-id="{{ $item['id'] }}" onclick="flipCard(this)">
                <div class="front" style="background-image: url('{{ asset('img/pregunta.jpg') }}')"></div>
                <div class="back">
                    @if ($item['type'] === 'image')
                    <img src="{{ asset('img/memorama/' . $item['content']) }}" alt="Imagen">
                    @else
                    <p>{{ $item['content'] }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div id="feedback" style="display: none;"></div>

    <!-- Modal de instrucciones -->
    <div id="instructionsModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Instrucciones del Juego</h2>
            <p>El objetivo del juego es encontrar todas las parejas de cartas iguales en el menor tiempo posible y con el menor número de intentos.</p>
            <ul>
                <li>Haz clic en una carta para voltearla.</li>
                <li>Haz clic en una segunda carta para intentar encontrar la pareja.</li>
                <li>Si las cartas son iguales, permanecerán volteadas. Si no, se voltearán de nuevo.</li>
                <li>El juego termina cuando encuentres todas las parejas.</li>
            </ul>
            <button id="closeInstructions">Cerrar</button>
        </div>
    </div>

    <script src="{{ asset('js/memorama.js') }}"></script>
</body>
</html>
