<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LifeBal</title>
    <link rel="stylesheet" href="{{ asset('css/carrusel.css') }}">
    <style>
        body,html{
            margin:0;
        }
    </style>
</head>
<body>

    <!-- Banner superior -->
    <div class="fondo">
        <img class="car" src="/img/car.jpg" alt="">
        <div class="overlay"></div>
    </div>
    <div id="banner-superior">
        <img id="imagen-izquierda" src="img/uni.png" alt="Imagen Izquierda">
        <div id="contenedor-centrado">
            <img id="imagen-centrada" src="img/inicio.jpg" alt="Imagen Centrada">
        </div>
    </div>

    <!-- Carrusel -->
    <div class="container__slider">
        <div class="container">
            <input type="radio" name="slider" id="item-1" checked>
            <input type="radio" name="slider" id="item-2">
            <input type="radio" name="slider" id="item-3">
            <input type="radio" name="slider" id="item-4">
            <div class="cards">
                <label class="card" for="item-1" id="selector-1" data-link="juegos/quiz">
                    <div class="image-container">    
                        <img src="/img/quiz.png">   
                    </div>
                </label>
                <label class="card" for="item-2" id="selector-2" data-link="juegos/crucigrama">
                    <div class="image-container">    
                        <img src="/img/crucigrama.png">
                    </div>
                </label>
                <label class="card" for="item-3" id="selector-3" data-link="juegos/memorama">
                    <div class="image-container">    
                        <img src="/img/memorama.png">
                    </div>
                </label>
                <label class="card" for="item-4" id="selector-4" data-link="juegos/sopa_letras">
                    <div class="image-container"> 
                        <img src="/img/sopa.png">
                    </div>
                </label>
            </div>
        </div>
    </div>
    
    <div id="instructions-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Instrucciones</h2>
            <p>Sigue estas instrucciones para seleccionar un juego:</p>
            <ul>
                <li><strong>Navegación</strong>: Haz clic en una de las imágenes del carrusel para seleccionar un juego.</li>
                <li><strong>Seleccionar Juego</strong>: Si la imagen elegida está marcada, da clic y serás redirigido al juego.</li>
                <li><strong>Juegos Disponibles</strong>: Puedes elegir entre Quiz, Crucigrama, Memorama, y Sopa de Letras.</li>
            </ul>
            <button id="closeInstructions">Cerrar</button>
        </div>
    </div>               
    <br>                                                                                      
    <div id="banner-inferior">
    <div class="container2">
        <div class="row">
            <div class="col-md-4">
                <button class="btn-89" id="mapa">
                    <a href="https://maps.app.goo.gl/32ukcNBnNUtG9A8K8" target="_blank" rel="noopener noreferrer" class="btn-89">
                        <svg viewBox="0 0 45.917 45.917">
                            <path d="M33.523,28.334c-0.717,1.155-1.498,2.358-2.344,3.608c7.121,1.065,10.766,3.347,10.766,4.481c0,1.511-6.459,5.054-18.986,5.054c-12.528,0-18.988-3.543-18.988-5.054c0-1.135,3.645-3.416,10.768-4.481c-0.847-1.25-1.628-2.453-2.345-3.608C5.365,29.661,0,32.385,0,36.424c0,5.925,11.551,9.024,22.959,9.024s22.958-3.1,22.958-9.024C45.917,32.385,40.553,29.661,33.523,28.334z"></path>
                            <path d="M22.96,36.047c1.032,0,2.003-0.491,2.613-1.325c3.905-5.33,10.813-15.508,10.813-20.827c0-7.416-6.012-13.427-13.427-13.427c-7.417,0-13.427,6.011-13.427,13.427c0,5.318,6.906,15.497,10.812,20.827C20.957,35.556,21.928,36.047,22.96,36.047z M17.374,13.63c0-3.084,2.5-5.584,5.585-5.584c3.084,0,5.584,2.5,5.584,5.584s-2.5,5.584-5.584,5.584C19.874,19.215,17.374,16.715,17.374,13.63z"></path>
                        </svg>
                    </a>
                </button>
                <div class="ubicacion">
                    <h2 class="card-title-soporte">Ubicación</h2>
                    <p class="card-text-soporte">Av. Tecnológico No. 1555 Sur <br> Periférico Gómez - Lerdo Km. 14.5, <br> Ciudad Lerdo, Estado de Durango C.P. 35150.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div id="visit-counter">
                    <h2>Contador de visitas: <span id="visit-count">0</span></h2>
                </div>
            </div>
            <div class="col-md-4">
                <button class="btn-94" id="correo" onclick="window.location.href='mailto:subdirposgrado_investigacion@itslerdo.edu.mx'">
                    <svg viewBox="0 0 512 512">
                        <path d="M309.333,341.333c29.419,0,53.333-23.936,53.333-53.333V96c0-29.397-23.915-53.333-53.333-53.333h-256C23.915,42.667,0,66.603,0,96v192c0,29.397,23.915,53.333,53.333,53.333h32v53.333c0,4.032,2.283,7.723,5.888,9.536c1.493,0.747,3.136,1.131,4.779,1.131c2.261,0,4.523-0.725,6.4-2.133l82.496-61.867H309.333z"></path>
                        <path d="M458.667,106.667h-64c-5.888,0-10.667,4.779-10.667,10.667V288c0,41.173-33.493,74.667-74.667,74.667H195.563c-2.304,0-4.565,0.747-6.4,2.133l-17.685,13.269c-2.731,2.048-4.309,5.248-4.267,8.64c0.043,3.392,1.685,6.571,4.459,8.555c9.173,6.592,19.904,10.069,30.997,10.069h124.437L409.6,467.2c1.877,1.408,4.117,2.133,6.4,2.133c1.621,0,3.264-0.384,4.779-1.131c3.605-1.813,5.888-5.504,5.888-9.536v-53.333h32C488.085,405.333,512,381.397,512,352V160C512,130.603,488.085,106.667,458.667,106.667z"></path>
                    </svg>
                </button>
                <div class="mail">
                    <h2>Contactanos</h2>
                    <p>
                        <strong>subdirposgrado_investigacion@itslerdo.edu.mx</strong><br> 
                        M.A.T.I Lilia Parada Morado<br> 
                        Dra. Elena Tzetzangary Aguirre Mejía <br> 
                        M.A.T.S.I Rocio Lorena Rodriguez Chacon
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>


    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
