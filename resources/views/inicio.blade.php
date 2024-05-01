<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LifeBal</title>
    
    <link rel="stylesheet" href="{{ asset('css/carrusel.css') }}">

    <style>
     
      /* Estilo personalizado para eliminar el margen vertical */
      body, html {
          margin: 0;
          
      }

        /* Estilo para el banner superior */
        .banner.superior {
            background-color: #f1c462; /* Color de fondo */
            color:#000000;
            text-align:center;
            font-family: 'Vibur', cursive;
          
        }

    </style>
</head>
<body>

  <!-- Banner superior -->
  <div class="banner superior">
    <h1>LifeBal</h1>
  </div>

    

    <!-- //////////////////////////////////////////////////////
         ESTE ES EL CARRUSEL
         //////////////////////////////////////////////////////-->

         <div class="container__slider">

          <div class="container">
              <input type="radio" name="slider" id="item-1" checked>
              <input type="radio" name="slider" id="item-2">
              <input type="radio" name="slider" id="item-3">
              <input type="radio" name="slider" id="item-4">
      
              <div class="cards">
                  <label class="card" for="item-1" id="selector-1">
                      <a href="juegos/quiz"><img src="/img/quiz.png"></a>     
                  </label>

                  <label class="card" for="item-2" id="selector-2">
                      <a href="juegos/crucigrama"><img src="/img/crucigrama.png"></a>
                  </label>

                  <label class="card" for="item-3" id="selector-3">
                      <a href="juegos/memorama"><img src="/img/memorama.png"></a>
                  </label>

                  <label class="card" for="item-4" id="selector-4">
                      <a href="juegos/sopa_letras"><img src="/img/sopa.png"></a>
                  </label>
              </div>
          </div>
      </div>
      
         



      
   


</body>
</html>