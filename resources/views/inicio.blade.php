<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LifeBal</title>
    
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<br>
<br>
    <!-- //////////////////////////////////////////////////////
         ESTE ES EL CARRUSEL
         //////////////////////////////////////////////////////-->

    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
    <a href="juegos/quiz"><img src="/img/quiz.png" class="" alt="..."></a>
      <div class="carousel-caption d-none d-md-block">
        <h5>Quiz</h5>
        <p class="texto">Some representative placeholder content for the first slide.</p>
      </div>
    </div>
    <div class="carousel-item">
    <a href="juegos/crucigrama"><img src="/img/crucigrama.jpeg" class="" alt="..."></a>
      <div class="carousel-caption d-none d-md-block">
        <h5>Crusigrama</h5>
        <p class="texto">Some representative placeholder content for the second slide.</p>
      </div>
    </div>
    <div class="carousel-item">
      <a href="juegos/memorama"> <img src="/img/memorama.jpeg" class="" alt="..."> <a href=""></a>
      <div class="carousel-caption d-none d-md-block">
        <h5>Memorama</h5>
        <p class="texto">Some representative placeholder content for the third slide.</p>
      </div>
    </div>
    <div class="carousel-item">
      <a href="juegos/sopa_letras"> <img src="/img/sopa.png" class="..." alt="..."> <a href=""></a>
      <div class="carousel-caption d-none d-md-block">
        <h5>Sopa de Letras</h5>
        <p style="black">Some representative placeholder content for the third slide.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>