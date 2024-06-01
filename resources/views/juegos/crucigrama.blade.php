<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LifeBal</title>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>
<body class="crusi">
<div class="background">
  <img class="doc" src="/img/doc2.jpg" alt="">
  <div class="overlay"></div>
</div>
<h1 class="uno">Crucigrama</h1>

<a href="/inicio"><button id="backButton">Regresar</button></a>
<div class="puntuacion"> 
    <span>Intentos: <span id="intentos">0</span></span>
    <span>Puntaje: <span id="puntaje">0</span></span>
    <span>Tiempo: <span id="tiempo">00:00</span></span>
</div>

<br>
<table id="crucigrama-grid"></table>
<button id="IniciarC" onclick="iniciarJuego()">Iniciar</button>
<button id="pistaButton">Pista</button>

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
        <p>Sigue estas instrucciones para jugar el crucigrama:</p>
        <ul>
            <li><strong>Inicio del Juego</strong>: Presiona el botón "Iniciar" para comenzar el crucigrama.</li>
            <li><strong>Selección de Pistas</strong>: Utiliza el botón "Pista" para mostrar una pista durante 10 segundos.</li>
            <li><strong>Llenado del Crucigrama</strong>: Haz clic en las celdas del crucigrama para ingresar tus respuestas.</li>
            <li><strong>Puntuación</strong>: Los intentos y el puntaje se actualizarán automáticamente.</li>
            <li><strong>Verticales y Horizontales</strong>: En la parte inferior de la pagina se veran un listado de las descripciones de las palabras que estan en el crucigrama.</li>
            <li><strong>Regresar</strong>: Puedes regresar a la página anterior en cualquier momento presionando el botón "Regresar".</li>
        </ul>
        <button id="closeInstructions">Cerrar</button>
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
    
</script>
</body>
</html>
