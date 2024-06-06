document.addEventListener('DOMContentLoaded', () => {
    // Obtener elementos del DOM
    const modal = document.getElementById('instructionsModal');
    const span = document.getElementsByClassName('close')[0];
    const closeInstructions = document.getElementById('closeInstructions');

    // Mostrar el modal al cargar la página
    modal.style.display = 'flex';

    // Cerrar el modal al hacer clic en la 'x'
    span.onclick = function() {
        modal.style.display = 'none';
    }

    // Cerrar el modal al hacer clic en el botón de cerrar
    closeInstructions.onclick = function() {
        modal.style.display = 'none';
    }

    // Cerrar el modal si se hace clic fuera del contenido del modal
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
});
document.addEventListener('DOMContentLoaded', function() {
    const btnStartQuiz = document.getElementById('btn-start-quiz');
    const quizContainer = document.getElementById('quiz-container');
    const btnNext = document.getElementById('btn-next');
    const btnSubmit = document.getElementById('btn-submit');
    const btnBack = document.getElementById('btn-back');
    const btnShowResults = document.getElementById('btn-show-results');
    const questionText = document.getElementById('question-text');
    const optionA = document.getElementById('option-a');
    const optionB = document.getElementById('option-b');
    const optionC = document.getElementById('option-c');
    const optionD = document.getElementById('option-d');
    const timerDisplay = document.getElementById('timer');
    const scoreDisplay = document.getElementById('score');
    const viewResultsButton = document.getElementById('viewResultsButton');
    const modal = document.getElementById('resultsModal');
    const closeModal = document.getElementById('closeModal1');

    let startTime;
    let endTime;
    let currentQuestionIndex = 0;
    const answers = {};

    // Configuración para limpiar localStorage cada 40 minutos (2400000 ms)
    setInterval(() => {
        localStorage.clear();
        alert("El almacenamiento local ha sido limpiado automáticamente después de 40 minutos.");
    }, 2400000);

    btnStartQuiz.addEventListener('click', function() {
        startTime = Date.now();
        updateClock();

        btnStartQuiz.style.display = 'none';
        quizContainer.style.display = 'block';

        showQuestion(0);
    });

    function updateClock() {
        let elapsedTime;
        if (endTime) {
            elapsedTime = endTime - startTime;
        } else {
            elapsedTime = Date.now() - startTime;
        }

        const minutes = Math.floor(elapsedTime / 60000);
        const seconds = Math.floor((elapsedTime % 60000) / 1000);
        timerDisplay.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        setTimeout(updateClock, 1000);
    }

    function showQuestion(index) {
        const currentQuestion = questions[index];
        questionText.textContent = currentQuestion.question;
        optionA.textContent = `A) ${currentQuestion.option_a}`;
        optionB.textContent = `B) ${currentQuestion.option_b}`;
        optionC.textContent = `C) ${currentQuestion.option_c}`;
        optionD.textContent = `D) ${currentQuestion.option_d}`;

        const answer = answers[currentQuestion.id];
        if (answer) {
            document.querySelector(`input[name="answers"][value="${answer}"]`).checked = true;
        } else {
            document.querySelectorAll('input[name="answers"]').forEach(input => {
                input.checked = false;
            });
        }

        btnBack.style.display = index === 0 ? 'none' : 'inline';
    }

    btnNext.addEventListener('click', function() {
        const selectedAnswer = document.querySelector('input[name="answers"]:checked');
        if (selectedAnswer) {
            answers[questions[currentQuestionIndex].id] = selectedAnswer.value;
        }

        currentQuestionIndex++;
        if (currentQuestionIndex < questions.length) {
            showQuestion(currentQuestionIndex);
        } else {
            btnNext.style.display = 'none';
            btnSubmit.style.display = 'inline';
        }
    });

    btnSubmit.addEventListener('click', function() {
        endTime = Date.now();
        let score = 0;
        questions.forEach(question => {
            if (answers[question.id] === question.correct_answer) {
                score += 100;
            }
        });

        // Mostrar solo la puntuación y el botón de ver respuestas
        scoreDisplay.textContent = `Tu puntaje es: ${score}`;
        document.getElementById('result-container').style.display = 'block';
        btnShowResults.style.display = 'block';

        // Ocultar el contenedor de preguntas
        quizContainer.style.display = 'none';
        btnBack.style.display = 'none';
        btnSubmit.style.display = 'none';

        // Guardar resultados en localStorage
        const playerName = localStorage.getItem('playerName');
        if (!playerName) {
            alert('Error: El nombre del jugador no está disponible.');
            return;
        }
        saveResult(playerName, score, Math.floor((endTime - startTime) / 1000));
    });

    btnBack.addEventListener('click', function() {
        currentQuestionIndex--;
        showQuestion(currentQuestionIndex);
    });

    btnShowResults.addEventListener('click', function() {
        const answersList = document.getElementById('answers-list');
        answersList.innerHTML = ""; // Limpiar la lista de respuestas

        questions.forEach(question => {
            const li = document.createElement('li');
            const answerGiven = answers[question.id];
            const correctAnswer = question.correct_answer;

            let answerText = "";
            let correctAnswerText = "";
            let isCorrect = answerGiven === correctAnswer;

            switch (answerGiven) {
                case 'A':
                    answerText = question.option_a;
                    break;
                case 'B':
                    answerText = question.option_b;
                    break;
                case 'C':
                    answerText = question.option_c;
                    break;
                case 'D':
                    answerText = question.option_d;
                    break;
                default:
                    answerText = "No respondida";
                    isCorrect = false; // Marcar como incorrecta si no se respondió
            }

            switch (correctAnswer) {
                case 'A':
                    correctAnswerText = question.option_a;
                    break;
                case 'B':
                    correctAnswerText = question.option_b;
                    break;
                case 'C':
                    correctAnswerText = question.option_c;
                    break;
                case 'D':
                    correctAnswerText = question.option_d;
                    break;
            }

            li.innerHTML = `<strong>${question.question}</strong><br>Tu respuesta: ${answerText}<br>Respuesta correcta: ${correctAnswerText}`;
            li.classList.add(isCorrect ? 'correct-answer' : 'incorrect-answer');

            answersList.appendChild(li);
        });

        btnBack.style.display = 'none';
        btnSubmit.style.display = 'none';
        btnShowResults.style.display = 'none';
        document.getElementById('answers-container').style.display = 'block';
    });

    function saveResult(name, score, time) {
        let results = JSON.parse(localStorage.getItem('quiz_results')) || [];
        results.push({ name, score, time });
        if (results.length > 5) {
            results.shift(); // Mantener solo los últimos 5 resultados
        }
        localStorage.setItem('quiz_results', JSON.stringify(results));
    }

    viewResultsButton.addEventListener('click', viewResults);

    function viewResults() {
        const results = JSON.parse(localStorage.getItem('quiz_results')) || [];
        const resultsList = document.getElementById('results-list');
        resultsList.innerHTML = ''; // Limpiar la lista de resultados

        results.forEach(result => {
            const minutes = Math.floor(result.time / 60);
            const seconds = result.time % 60;
            const timeFormatted = `${pad(minutes)}:${pad(seconds)}`;
            const li = document.createElement('li');
            li.textContent = `Nombre: ${result.name}, Puntuación: ${result.score}, Tiempo: ${timeFormatted}`;
            resultsList.appendChild(li);
        });

        modal.style.display = 'block';
    }

    closeModal.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    };
    function pad(value) {
        return value.toString().padStart(2, '0');
    };
});
