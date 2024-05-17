<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    

</head>
<body>
<body>
    <title>LifeBal</title><h1>Sopa De Letras</h1>

    <a href="{{asset("/inicio")}}"><button>Volver</button></a>
    
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