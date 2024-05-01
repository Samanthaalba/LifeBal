<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LifeBal</title>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">

    <style>
        
    </style>
</head>
<body class="crusi">
<h1 class="uno">Crucigrama</h1>

<a href="/inicio"><button id="btn-regresar">Regresar</button></a>

<table id="crucigrama-grid"></table>
<div class="crucigrama-container">
        <div>
        <button onclick="verificarPalabras()">Verificar</button>
            <h2>Horizontales</h2>
            <ul class="palabras-lista">
                @foreach($palabras as $palabra)
                    @if($palabra->direccion == 'horizontal')
                        <li>{{ $palabra->id }} {{ $palabra->pista }}</li>
                    @endif
                @endforeach
            </ul>
        </div>
        <div>
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

    <script src="{{ asset('js/crusigrama.js') }}"></script>
</body>
</html>