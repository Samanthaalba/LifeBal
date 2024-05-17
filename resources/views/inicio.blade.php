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
        background-color: rgb(247, 152, 191);
         
      }

        /* Estilo para el banner superior */
        #banner-superior {
            background-color: #f1c462; /* Color de fondo */
            color:#000000;
            text-align:center;
            padding: 10px 0;
          
        }

    #banner-superior img {
        max-width: 100%;
        height: auto;
        margin: 0 auto;
    }

    /* Estilos para el banner inferior */
    #banner-inferior {
        background-color: #f1c462;
        padding: 20px 0;
        text-align: center;
    }
    #banner-inferior a {
        margin-right: 20px;
        color: #007bff;
        text-decoration: none;
    }

    </style>
</head>
<body>

  <!-- Banner superior -->
  
  <div id="banner-superior">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="img/uni.png" alt="Imagen Izquierda">
            </div>
            <div class="col-md-6">
                <img src="img/nombre.jpeg" alt="Imagen Centrada">
            </div>
        </div>
    </div>
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
                  <div class="image-container">    
                  <img src="/img/quiz.png">   
                  </div>
                  </label>

                  <label class="card" for="item-2" id="selector-2"  data-link="juegos/crucigrama">
                  <div class="image-container">    
                    <img src="/img/crucigrama.png">
                    </div>
                  </label>

                  <label class="card" for="item-3" id="selector-3"  data-link="juegos/memorama">
                  <div class="image-container">    
                        <img src="/img/memorama.png">
                        </div>
                  </label>

                  <label class="card" for="item-4" id="selector-4"  data-link="juegos/sopa_letras">
                  <div class="image-container"> 
                      <img src="/img/sopa.png">
                      </div>
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
<br>
<br>
<div id="banner-inferior">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="ruta/a/pagina-1.html">Enlace 1</a>
                <a href="ruta/a/pagina-2.html">Enlace 2</a>
                <a href="ruta/a/pagina-3.html">Enlace 3</a>
                <p>Descripción breve del banner inferior.</p>
            </div>
        </div>
    </div>
</div> 
   


</body>
</html>