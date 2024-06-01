<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LifeBal</title>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <style>
        body {
            background-color: #f5daa0; 
        }</style>
</head>
<body> 
<a href="/inicio"><button id="backButton">Regresar</button></a>
    <div class="containerquiz">
        <h1>Quiz sobre Prevención del Embarazo Adolescente</h1>
        <div class="Iniciarbtn"> <button id="btn-start-quiz">Iniciar Quiz</button> </div><br>
        <div id="Marcador">
            <p>Tiempo: <span id="tiempoQuiz">00:00</span></p>
        </div>
        <div id="result-container" style="display: none;">
            <h2>Resultados del Quiz</h2>
            <p id="score-text"></p>
            <button id="btn-show-results">Ver Respuestas</button>
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

    <div id="instructionsModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Instrucciones</h2>
            <p>El objetivo del quiz es contestar correctamente las preguntas con tu conocimientos previos sobre el tema de prevencion del embarazo adolecente </p>
            <ul>
                <li><strong>Inicio del Quiz</strong>: Presiona el botón "Iniciar Quiz" para comenzar el cuestionario.</li>
                <li><strong>Selección de Respuestas</strong>: Para cada pregunta, selecciona una de las opciones proporcionadas (A, B, C, D) haciendo clic en el botón de radio correspondiente.</li>
                <li><strong>Navegación</strong>: Utiliza el botón "Siguiente" para pasar a la siguiente pregunta. Si deseas revisar una pregunta anterior, puedes utilizar el botón "Atrás".</li>
                <li><strong>Envio del Quiz</strong>: Una vez que hayas respondido todas las preguntas, presiona el botón "Enviar" para finalizar el cuestionario.</li>
                <li><strong>Resultados</strong>: Después de enviar el cuestionario, se mostrará tu puntaje y tendrás la opción de ver las respuestas correctas y tus respuestas.</li>
            </ul>
            <button id="closeInstructions">Cerrar</button>
        </div>
    </div>

    <script>
        const questions = {!! json_encode($questions) !!};
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>