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

    <a href="/inicio"><button>regresar</button></a>
    
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
                    <!-- Asegúrate de que el ID siga el formato `palabra-{palabraEnMinusculas}` -->
                    <li id="palabra-sifilis" class="palabra">SIFILIS</li>
                    <li id="palabra-herpes" class="palabra">HERPES</li>
                    <li id="palabra-gonorrea" class="palabra">GONORREA</li>
                    <li id="palabra-clamidia" class="palabra">CLAMIDIA</li>
                    <li id="palabra-candidiasis" class="palabra">CANDIDIASIS</li>
                    <li id="palabra-tricomoniasis" class="palabra">TRICOMONIASIS</li>
                    <li id="palabra-hepatitis" class="palabra">HEPATITIS</li>
                    <li id="palabra-vih" class="palabra">VIH</li>
                    <li id="palabra-sida" class="palabra">SIDA</li>
                    <li id="palabra-ulcera" class="palabra">ULCERA</li>
                    <li id="palabra-vph" class="palabra">VPH</li>
                    <li id="palabra-hiv" class="palabra">HIV</li>
                    <li id="palabra-lues" class="palabra">LUES</li>
                    <li id="palabra-molusco" class="palabra">MOLUSCO</li>
                    <li id="palabra-chancro" class="palabra">CHANCO</li>
                    <li id="palabra-balanitis" class="palabra">BALANITIS</li>
                    <li id="palabra-uretritis" class="palabra">URETRITIS</li>
                    <li id="palabra-condiloma" class="palabra">CONDILOMA</li>
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
                    <li id="palabra-pubis" class="palabra">PUBIS</li>
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

// Alternativamente, si tienes un botón específico para "Regresar", podrías vincular un evento de clic a ese botón:
document.querySelector('a[href="/inicio"]').addEventListener('click', function(e) {
  if (!confirm('Se perderán los cambios realizados si regresas. ¿Quieres continuar?')) {
      e.preventDefault(); // Evitar que el enlace navegue realmente
  }
});
    </script>
</body>
</html>