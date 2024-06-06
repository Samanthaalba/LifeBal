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
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.4); 
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; 
            padding: 20px;
            border: 1px solid #888;
            width: 80%; 
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
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

<!-- Modal de resultados -->
<div id="resultsModal" class="modal1">
    <div class="modal-content1">
        <span id="closeResultsModal" class="close1">&times;</span>
        <h2>Resultados Anteriores</h2>
        <ul id="results-list"></ul>
    </div>
</div>

<button id="viewResultsButton" class="verpuntosmemo">Ver Resultados</button>

<script src="{{ asset('js/memorama.js') }}"></script>
<script>
    window.addEventListener('beforeunload', function (e) {
            e.preventDefault();
            e.returnValue = '';
        });
   
</script>
</body>
</html>
