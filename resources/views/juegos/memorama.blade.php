<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LifeBal</title>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>
<body>

    <h1>Memorama</h1>
        <br>
        <a href="/inicio"><button id="backButton">regresar</button></a>
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

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
