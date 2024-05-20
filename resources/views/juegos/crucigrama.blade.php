<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LifeBal</title>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>
<body class="crusi">
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
<button id="VerificarC" onclick="verificarPalabras()">Verificar</button>
<button id="pistaButton" onclick="togglePistaList()">Pista</button>
<div class="PalabrasC">
    <ul id="pistaList">
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

<script src="{{ asset('js/crusigrama.js') }}"></script>
<script>
function togglePistaList() {
    var pistaList = document.getElementById('pistaList');
    if (pistaList.style.display === 'none' || pistaList.style.display === '') {
        pistaList.style.display = 'block';
    } else {
        pistaList.style.display = 'none';
    }
}
</script>
</body>
</html>
