<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <title>LifeBal</title>
    
<style>
     body {
            background-color: #f5daa0; 
        }
</style>
</head>
<body>
<body>
<h1>Sopa De Letras</h1>
    <div class="background">
        <img class="doc" src="/img/doc2.jpg" alt="">
        <div class="overlay"></div>
    </div>

    <a href="{{asset('/inicio')}}"><button id="backButton">Regresar</button></a>
    <div id="scorePanelSp"> 
        <p>Intentos: <span id="Attempts">0</span></p>
        <p>Puntos: <span id="Score">0</span></p>
        <p>Tiempo: <span id="Timer">00:00</span></p>
    </div>
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
            <p>Sigue estas instrucciones para jugar la sopa de letras:</p>
            <ul>
                <li><strong>Inicio del Juego</strong>: Presiona el botón "Iniciar Juego" para comenzar la sopa de letras.</li>
                <li><strong>Selección de Palabras</strong>: Busca las palabras en la lista y márcalas en la sopa de letras.</li>
                <li><strong>Llenado de la Sopa</strong>: Haz clic y arrastra para seleccionar las letras de las palabras encontradas.</li>
                <li><strong>Puntuación</strong>: Los intentos y el puntaje se actualizarán automáticamente.</li>
                <li><strong>Regresar</strong>: Puedes regresar a la página anterior en cualquier momento presionando el botón "Regresar".</li>
            </ul>
            <button id="closeInstructions">Cerrar</button>
        </div>
    </div>


    <script src="/js/app.js"></script>
    <script>
        window.addEventListener('beforeunload', function (e) {
  // Cancelar el evento como estándar indica
  e.preventDefault();
  // Chrome requiere que se establezca el valor de retorno
  e.returnValue = '';
});

// Alternativamente, si tienes un botón específico para "Volver", podrías vincular un evento de clic a ese botón:
document.querySelector('a[href="/inicio"]').addEventListener('click', function(e) {
  if (!confirm('Se perderán los cambios realizados si regresas. ¿Quieres continuar?')) {
      e.preventDefault(); // Evitar que el enlace navegue realmente
  }
});
    </script>
</body>
</html>