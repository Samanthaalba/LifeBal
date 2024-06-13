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
<a href="/inicio">
    <button id="backButton" class="cta">
      <svg width="15px" height="10px" viewBox="0 0 13 10">
        <path d="M12,5 L2,5"></path> 
        <polyline points="5 1 1 5 5 9"></polyline> <!-- Modificado para apuntar a la izquierda -->
      </svg>
      <span>Regresar</span>
    </button>
  </a>
<button onclick="refreshpage()" class="otravezmemo button">
    <svg class="svg-icon" fill="none" height="20" viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg"><g stroke="#ff342b" stroke-linecap="round" stroke-width="1.5"><path d="m3.33337 10.8333c0 3.6819 2.98477 6.6667 6.66663 6.6667 3.682 0 6.6667-2.9848 6.6667-6.6667 0-3.68188-2.9847-6.66664-6.6667-6.66664-1.29938 0-2.51191.37174-3.5371 1.01468"></path><path d="m7.69867 1.58163-1.44987 3.28435c-.18587.42104.00478.91303.42582 1.0989l3.28438 1.44986"></path></g></svg>
    <span class="lable">Repetir</span>
  </button>
  
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
        <p>El objetivo del juego es relacionar la imagen con la palabra en el menor tiempo posible. </p>
        <ul>
            <li><strong>Inicio del Juego</strong>:Haz clic en el botón "Iniciar juego".</li>
            <li><strong>Encontrar cartas</strong>:Haz clic en una primera carta.</li>
            <li><strong>Encontrar cartas</strong>:Haz clic en una segunda carta para intentar encontrar la pareja.</li>
            <li><strong>Atención</strong>:Si las cartas son iguales, se mantendrán volteadas.</li>
            <li><strong>Final</strong>:El juego termina cuando encuentres todas las parejas.</li>
            <li><strong>Puntuación</strong>: Los intentos y el puntaje se actualizarán automáticamente.</li>
            <li><strong>¡Para una mejor introducción al tema, mira el siguiente video!</strong></li>
        </ul>
        <button class="watchVideo4">
        <a href="https://youtu.be/adDdIWXus88" target="_blank">
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

<button id="viewResultsButton" class="verpuntosmemo"><strong>Puntuación Record</strong></button>


<script src="{{ asset('js/memorama.js') }}"></script>
<script>
    function refreshpage(){
        location.reload();
    }
   
</script>
</body>
</html>
