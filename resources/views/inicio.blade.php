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
                  <label class="card" for="item-1" id="selector-1"  data-link="juegos/quiz">
                      <img src="/img/quiz.png">   
                  </label>

                  <label class="card" for="item-2" id="selector-2"  data-link="juegos/crucigrama">
                      <img src="/img/crucigrama.png">
                  </label>

                  <label class="card" for="item-3" id="selector-3"  data-link="juegos/memorama">
                        <img src="/img/memorama.png">
                  </label>

                  <label class="card" for="item-4" id="selector-4"  data-link="juegos/sopa_letras">
                      <img src="/img/sopa.png">
                  </label>
              </div>
          </div>
      </div>
      
         


      <script>
    document.addEventListener("DOMContentLoaded", function() {
        const cards = document.querySelectorAll(".card");
        cards.forEach(card => {
            card.addEventListener("click", function() {
                const isChecked = card.getAttribute("for") === document.querySelector("input[name='slider']:checked").id;
                if (isChecked) {
                    window.location.href = card.getAttribute("data-link");
                }
            });
        });
    });
</script>

      
   


</body>
</html>