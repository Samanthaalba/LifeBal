<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LifeBal</title>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">

    <style>
     #btn-regresar {
        float: left;
     }
     button {
        margin-top: 20px;
        background-color: #74ee7e;
        margin-left: auto;
        margin-right: auto;
        display: block;
        }
    </style>
</head>
<body class="crusi">
<h1 class="uno">Crucigrama</h1>

<a href="/inicio"><button id="btn-regresar">Regresar</button></a>
<br>
<br>

<table id="crucigrama-grid"></table>
<button onclick="verificarPalabras()">Verificar</button>

<div class="crucigrama-container">
        <div>
            
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