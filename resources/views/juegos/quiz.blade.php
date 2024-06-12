<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LifeBal</title>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            background-color: #f5daa0; 
        }
    
    
    </style>
</head>
<body> 
<div class="background">
    <img class="doc" src="/img/quiz.jpg" alt="">
    <div class="overlay"></div>
</div>
<a href="/inicio"><button id="backButton">Regresar</button></a>
<div class="containerquiz">
    <h1>Quiz sobre Prevención del Embarazo Adolescente</h1>
    <div class="Iniciarbtn">
        <button id="btn-start-quiz">Iniciar Juego</button>
    </div><br>
    <div id="Marcador">
        <p>Tiempo: <span id="timer">00:00</span></p>
    </div>
    <div id="result-container" style="display: none;">
        <h2>Resultados del Quiz</h2>
        <p id="score"></p>
        <button id="btn-show-results">Ver Respuestas</button>
       
        <button onclick="refreshpage()" class="otravez button">
            <svg class="svg-icon" fill="none" height="20" viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg"><g stroke="#ff342b" stroke-linecap="round" stroke-width="1.5"><path d="m3.33337 10.8333c0 3.6819 2.98477 6.6667 6.66663 6.6667 3.682 0 6.6667-2.9848 6.6667-6.6667 0-3.68188-2.9847-6.66664-6.6667-6.66664-1.29938 0-2.51191.37174-3.5371 1.01468"></path><path d="m7.69867 1.58163-1.44987 3.28435c-.18587.42104.00478.91303.42582 1.0989l3.28438 1.44986"></path></g></svg>
            <span class="lable">Repetir</span>
          </button>
          
    </div>

    <div id="answers-container" style="display: none;">
        <h2>Respuestas</h2>
        <ul id="answers-list"></ul>
    </div>
    <div id="quiz-container" style="display: none;">
        <div class="question">
            <p id="question-text"></p>
            <label><input type="radio" name="answers" value="A"> <span id="option-a"></span></label><br>
            <label><input type="radio" name="answers" value="B"> <span id="option-b"></span></label><br>
            <label><input type="radio" name="answers" value="C"> <span id="option-c"></span></label><br>
            <label><input type="radio" name="answers" value="D"> <span id="option-d"></span></label>
        </div>
        <button id="btn-next">Siguiente</button>
        <button id="btn-back" style="display: none;">Atrás</button>
        <button id="btn-submit" style="display: none;">Enviar</button>
    </div>
</div>
<button id="viewResultsButton" class="verpuntosquiz">Puntuación Record</button>
<div id="instructionsModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Instrucciones</h2>
        <p>El objetivo del quiz es mostrar tus conocimientos previos sobre el tema de prevención del embarazo adolescente.</p>
        <ul>
            <li><strong>Inicio del Juego</strong>: Presiona "Iniciar Juego" para comenzar.</li>
            <li><strong>Selección de Respuestas</strong>: Elige una opción (A, B, C, D) haciendo clic en la respuesta.</li>
            <li><strong>Navegación</strong>: Usa "Siguiente" para avanzar y "Atrás" para revisar preguntas anteriores.</li>
            <li><strong>Envio del Quiz</strong>: Después de responder todas las preguntas, pulsa "Enviar" para terminar.</li>
            <li><strong>Resultados</strong>: Verás tu puntaje. Revisa las respuestas correctas y tus respuestas.</li>
            <li><strong>Puntuación</strong>: Los intentos y el puntaje se actualizarán automáticamente.</li>
            <li><strong>¡Para una mejor introducción al tema, mira el siguiente video!</strong></li>
        </ul>
        <button class="watchVideo3">
            <a href="https://youtu.be/sxGSNOWedI0" target="_blank">
                <span class="icon">
                  <svg fill="none" height="33" viewBox="0 0 120 120" width="33" xmlns="http://www.w3.org/2000/svg">
                    <path d="m120 60c0 33.1371-26.8629 60-60 60s-60-26.8629-60-60 26.8629-60 60-60 60 26.8629 60 60z" fill="#cd201f"></path>
                    <path d="m25 49c0-7.732 6.268-14 14-14h42c7.732 0 14 6.268 14 14v22c0 7.732-6.268 14-14 14h-42c-7.732 0-14-6.268-14-14z" fill="#fff"></path>
                    <path d="m74 59.5-21 10.8253v-21.6506z" fill="#cd201f"></path>
                  </svg>
                </span>
                <span class="text1">Ver Video</span>
              </a>
            </button>
            <br>
        <button id="closeInstructions">Cerrar</button>
    </div>
</div>

<div id="resultsModal" class="modal1">
    <div class="modal-content1">
        <span id="closeModal1" class="close1">&times;</span>
        <h2>Puntuación Record</h2>
        <ul id="results-list"></ul>
    </div>
</div>

<script>
    const questions = {!! json_encode($questions) !!};
</script>
<script src="{{ asset('js/quiz.js') }}"></script>
<script>
    function refreshpage(){
        location.reload();
    }
   
</script>
</body>
</html>
