/////////////////////////////////////////////////////////////////////////
// Logica del loguin para que el usuario no pueda entrar al inicio sin antes poner un nombre
/////////////////////////////////////////////////////////////////////////

document.addEventListener("DOMContentLoaded", function() {
  const userNameInput = document.getElementById("UserName");
  const loginBtn = document.getElementById("loginBtn");

  loginBtn.addEventListener("click", function(event) {
    if (!userNameInput.value.trim()) {
      event.preventDefault(); // Evitar la acción por defecto (redireccionamiento)
      alert("Por favor, complete el campo de Nombre del Jugador");
    }
  });
});

////////////////////////////////////////////////////////////////////////////////
///Sopa de letras 
////////////////////////////////////////////////////////////////////////////////
document.addEventListener('DOMContentLoaded', () => {
    let esMouseDown = false;
    let seleccionActual = [];
    let palabraFormada = '';
    let attempts = 0;
    let score = 0;
    let foundWords = 0;
    let timerInterval;
    let totalSeconds = 0;
    let gameEnded = false;
    let gameStarted = false; // Bandera para verificar si el juego ha comenzado

    const palabrasValidas = [
        'CUIDADO', 'ADOLESCENCIA', 'FAMILIA', 'ENFERMEDADES', 'ORIENTACION', 'EMBARAZO', 
        'ANTICONCEPTIVO', 'EDUCACION', 'SALUD','PREVENCION', 'SEXUALIDAD', 'RESPONSABILIDAD', 
        'INFORMACION', 'APOYO', 'RESPETO','COMUNICACION'
    ].map(palabra => palabra.toUpperCase());

    const letras = document.querySelectorAll('.letra');
    const startButton1 = document.getElementById('startButton1');
    const attemptsDisplay = document.getElementById('Attempts');
    const scoreDisplay = document.getElementById('Score');
    const timerDisplay = document.getElementById('Timer');

    startButton1.addEventListener('click', startGame);

    letras.forEach(letra => {
        letra.addEventListener('mousedown', (event) => {
            if (gameStarted && !gameEnded) {
                esMouseDown = true;
                agregarLetraASeleccion(event.target);
                event.preventDefault();
            }
        });

        letra.addEventListener('mouseenter', (event) => {
            if (gameStarted && esMouseDown && !gameEnded) {
                agregarLetraASeleccion(event.target);
            }
        });
    });

    document.addEventListener('mouseup', () => {
        if (gameStarted && esMouseDown && palabraFormada.length > 0) {
            verificarPalabra();
            attempts++;
            attemptsDisplay.textContent = attempts;
        }
        esMouseDown = false;
    });

    window.onunload = function() {
        if (gameStarted && !gameEnded) {
            clearInterval(timerInterval);
            alert("Has salido del juego antes de terminar.");
        }
    };

    function startGame() {
        attempts = 0;
        score = 0;
        foundWords = 0;
        totalSeconds = 0;
        gameEnded = false;
        gameStarted = true; // Marcar que el juego ha comenzado

        attemptsDisplay.textContent = attempts;
        scoreDisplay.textContent = score;
        timerDisplay.textContent = '00:00';

        letras.forEach(letra => letra.classList.remove('letra-seleccionada', 'letra-encontrada'));
        document.querySelectorAll('.palabra').forEach(palabra => palabra.classList.remove('palabra-encontrada'));

        clearInterval(timerInterval);
        timerInterval = setInterval(updateTimer, 1000);
    }

    function agregarLetraASeleccion(letra) {
        if (!seleccionActual.includes(letra)) {
            letra.classList.add('letra-seleccionada');
            seleccionActual.push(letra);
            palabraFormada += letra.textContent.toUpperCase();
        }
    }

    function verificarPalabra() {
        if (palabrasValidas.includes(palabraFormada)) {
            seleccionActual.forEach(letra => letra.classList.add('letra-encontrada'));
            tacharPalabraLista(palabraFormada);
            score += calcularPuntaje();
            scoreDisplay.textContent = score;

            foundWords++;
            if (foundWords === palabrasValidas.length) {
                stopGame();
            }
        } else {
            limpiarSeleccionActual();
        }
        seleccionActual = [];
        palabraFormada = '';
    }

    function stopGame() {
        clearInterval(timerInterval);
        gameEnded = true;
        alert("¡Has encontrado todas las palabras!");
    }

    function calcularPuntaje() {
        if (totalSeconds < 10) {
            return 100;
        } else if (totalSeconds < 30) {
            return 90;
        } else {
            return 80;
        }
    }

    function limpiarSeleccionActual() {
        seleccionActual.forEach(letra => letra.classList.remove('letra-seleccionada'));
    }

    function tacharPalabraLista(palabra) {
        const palabraElemento = document.getElementById(`palabra-${palabra.toLowerCase()}`);
        if (palabraElemento) {
            palabraElemento.classList.add('palabra-encontrada');
        }
    }

    function updateTimer() {
        totalSeconds++;
        const minutes = Math.floor(totalSeconds / 60);
        const seconds = totalSeconds % 60;
        timerDisplay.textContent = `${pad(minutes)}:${pad(seconds)}`;
    }

    function pad(value) {
        return value.toString().padStart(2, '0');
    }
});




/*////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////
QUIZ
//////////////// ////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////*/
document.addEventListener('DOMContentLoaded', function() {
    const btnStartQuiz = document.getElementById('btn-start-quiz');
    const quizContainer = document.getElementById('quiz-container');
    let startTime;
    let endTime;

    btnStartQuiz.addEventListener('click', function() {
        // Iniciar el cronómetro
        startTime = Date.now();
        updateClock();

        // Ocultar el botón de inicio y mostrar el contenedor del cuestionario
        btnStartQuiz.style.display = 'none';
        quizContainer.style.display = 'block';

        // Mostrar la primera pregunta del cuestionario después de presionar el botón "Iniciar Quiz"
        showQuestion(0);
    });

    function updateClock() {
        let elapsedTime;
        if (endTime) {
            // Si ya se envió el cuestionario, calcular el tiempo total
            elapsedTime = endTime - startTime;
        } else {
            // Si aún no se ha enviado el cuestionario, calcular el tiempo transcurrido normalmente
            elapsedTime = Date.now() - startTime;
        }

        const minutes = Math.floor(elapsedTime / 60000);
        const seconds = Math.floor((elapsedTime % 60000) / 1000);
        document.getElementById('tiempoQuiz').textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        setTimeout(updateClock, 1000);
    }

    let currentQuestionIndex = 0;
    const answers = {};

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

    const btnNext = document.getElementById('btn-next');
    const btnSubmit = document.getElementById('btn-submit');
    const btnBack = document.getElementById('btn-back');
    const btnShowResults = document.getElementById('btn-show-results');
    const questionText = document.getElementById('question-text');
    const optionA = document.getElementById('option-a');
    const optionB = document.getElementById('option-b');
    const optionC = document.getElementById('option-c');
    const optionD = document.getElementById('option-d');

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
                score+=100;
            }
        });

        // Mostrar solo la puntuación y el botón de ver respuestas
        document.getElementById('score-text').textContent = `Tu puntaje es: ${score}`;
        document.getElementById('result-container').style.display = 'block';
        document.getElementById('btn-show-results').style.display = 'block';

        // Ocultar el contenedor de preguntas
        document.getElementById('quiz-container').style.display = 'none';
        document.getElementById('btn-back').style.display = 'none';
        document.getElementById('btn-submit').style.display = 'none';
    });

    btnBack.addEventListener('click', function() {
        currentQuestionIndex--;
        showQuestion(currentQuestionIndex);
    });

    btnShowResults.addEventListener('click', function() {
        // Mostrar las respuestas acertadas y falladas
        const answersList = document.getElementById('answers-list');
        answersList.innerHTML = ""; // Limpiar la lista de respuestas
    
        questions.forEach(question => {
            const li = document.createElement('li');
            const answerGiven = answers[question.id];
            const correctAnswer = question.correct_answer;
    
            // Obtener la respuesta completa
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
    
            // Agregar clases CSS para resaltar la respuesta
            li.innerHTML = `<strong>${question.question}</strong><br>Tu respuesta: ${answerText}<br>Respuesta correcta: ${correctAnswerText}`;
            li.classList.add(isCorrect ? 'correct-answer' : 'incorrect-answer');
    
            answersList.appendChild(li);
        });
    
        // Ocultar el contenedor de resultados y mostrar el de respuestas
        document.getElementById('btn-back').style.display = 'none';
        document.getElementById('btn-submit').style.display = 'none';
        document.getElementById('btn-show-results').style.display = 'none';
        document.getElementById('answers-container').style.display = 'block';
    });
});



//////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
/*ESTO ES SOBRE EL MEMRAMA */
///////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
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
document.addEventListener('DOMContentLoaded', () => {
    const startButton = document.getElementById('startButton');
    const cards = document.querySelectorAll('.card');
    let hasFlippedCard = false;
    let lockBoard = false;
    let firstCard, secondCard;
    let attempts = 0;
    let score = 0; 
    let gameStarted = false; 
    let interval;
    let seconds = 0, minutes = 0;

    startButton.addEventListener('click', startGame);

    function flipCard() {
        if (!gameStarted || lockBoard) return;
        if (this === firstCard) return;

        this.classList.add('flipped');

        if (!hasFlippedCard) {
            hasFlippedCard = true;
            firstCard = this;
            return;
        }

        secondCard = this;
        hasFlippedCard = false;
        checkForMatch();
    }

    function checkForMatch() {
        attempts++;
        document.getElementById('attempts').textContent = attempts;
        let isMatch = firstCard.dataset.id === secondCard.dataset.id;
    
        if (isMatch) {
            if (seconds <= 20) {
                score += 100;
            } else if (seconds <= 40) {
                score += 90;
            } else {
                score += 80;
            }
            
            document.getElementById('score').textContent = score;
            disableCards();
            if (score === cards.length * 100 / 2 || seconds >= 40) {
                clearInterval(interval);
            }
        } else {
            unflipCards();
        }
    }

    function disableCards() {
        firstCard.removeEventListener('click', flipCard);
        secondCard.removeEventListener('click', flipCard);
        resetBoard();
    }

    function unflipCards() {
        lockBoard = true;
        setTimeout(() => {
            firstCard.classList.remove('flipped');
            secondCard.classList.remove('flipped');
            resetBoard();
        }, 1000);
    }

    function resetBoard() {
        [hasFlippedCard, lockBoard] = [false, false];
        [firstCard, secondCard] = [null, null];
    }

    function startGame() {
        if (gameStarted) return;
        gameStarted = true;
        
        // Barajar las cartas antes de voltearlas
        cards.forEach(card => {
            card.style.order = Math.floor(Math.random() * cards.length);
        });

        cards.forEach(card => {
            card.classList.add('flipped');
            card.addEventListener('click', flipCard);
        });

        resetGame();

        setTimeout(() => {
            cards.forEach(card => card.classList.remove('flipped'));
            lockBoard = false; // Desbloquear el tablero después de 10 segundos
        }, 10000);

        startButton.disabled = true;
    }

    function resetGame() {
        if (interval) clearInterval(interval);
        [seconds, minutes, attempts, score] = [0, 0, 0, 0];
        document.getElementById('attempts').textContent = '0';
        document.getElementById('score').textContent = '0';
        document.getElementById('timer').textContent = '00:00';
        startTimer();
    }

    function startTimer() {
        interval = setInterval(() => {
            seconds++;
            if (seconds == 60) {
                minutes++;
                seconds = 0;
            }
            document.getElementById('timer').textContent = `${minutes < 10 ? '0' : ''}${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
        }, 1000);
    }
});

function preventLeaving() {
    window.addEventListener('beforeunload', handleBeforeUnload);
}

function allowLeaving() {
    window.removeEventListener('beforeunload', handleBeforeUnload);
}

function handleBeforeUnload(event) {
    event.preventDefault();
    event.returnValue = '¿Estás seguro de que quieres salir del juego?';
}

document.getElementById('startButton').addEventListener('click', () => {
    preventLeaving();

    const backButton = document.getElementById('backButton');
    if (backButton) {
        backButton.addEventListener('click', (e) => {
            e.preventDefault();
            const confirmLeave = confirm('¿Estás seguro de que quieres regresar al inicio y abandonar el juego?');
            if (confirmLeave) {
                allowLeaving();
                window.location.href = '/inicio';
            }
        });
    }
  });