document.addEventListener('DOMContentLoaded', () => {
    // Obtener elementos del DOM
    const modal = document.getElementById('instructionsModal');
    const span = document.getElementsByClassName('close')[0];
    const closeInstructions = document.getElementById('closeInstructions');

    // Mostrar el modal al cargar la página
    modal.style.display = 'flex';

    // Cerrar el modal al hacer clic en la 'x' o en el botón de cerrar
    span.onclick = closeInstructions.onclick = function() {
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
    // Obtener elementos del DOM
    const startButton = document.getElementById('startButton');
    const cards = document.querySelectorAll('.card');
    const attemptsDisplay = document.getElementById('attempts');
    const scoreDisplay = document.getElementById('score');
    const timerDisplay = document.getElementById('timer');
    const viewResultsButton = document.getElementById('viewResultsButton');
    const resultsModal = document.getElementById('resultsModal');
    const closeResultsModal = document.getElementById('closeResultsModal');

    let hasFlippedCard = false;
    let lockBoard = false;
    let firstCard, secondCard;
    let attempts = 0;
    let score = 0; 
    let gameStarted = false; 
    let interval;
    let seconds = 0, minutes = 0;

    const playerData = JSON.parse(sessionStorage.getItem('currentPlayer'));
    if (!playerData || !playerData.name) {
        alert('Debe ingresar un nombre en la página de inicio para continuar.');
        window.location.href = '/'; // Redirigir al inicio si no hay nombre
        return;
    }

    // Configuración para limpiar localStorage cada 1 hora (3600000 ms)
    setInterval(() => {
        localStorage.clear();
        alert("El almacenamiento local ha sido limpiado automáticamente después de 1 hora.");
    }, 3600000);

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
        attemptsDisplay.textContent = attempts;
        let isMatch = firstCard.dataset.id === secondCard.dataset.id;

        if (isMatch) {
            score += calculateScore();
            scoreDisplay.textContent = score;
            disableCards();

            // Verificar si se han encontrado todas las parejas
            if (document.querySelectorAll('.flipped').length === cards.length) {
                clearInterval(interval);
                alert("¡Has encontrado todas las parejas!");
                saveResult(score, minutes, seconds, attempts); // Asegúrate de pasar los parámetros
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
            lockBoard = false;
        }, 3000);

        startButton.disabled = true;
        startButton.style.display = 'none';
    }

    function resetGame() {
        if (interval) clearInterval(interval);
        [seconds, minutes, attempts, score] = [0, 0, 0, 0];
        attemptsDisplay.textContent = '0';
        scoreDisplay.textContent = '0';
        timerDisplay.textContent = '00:00';
        startTimer();
    }

    function startTimer() {
        interval = setInterval(() => {
            seconds++;
            if (seconds == 60) {
                minutes++;
                seconds = 0;
            }
            timerDisplay.textContent = `${pad(minutes)}:${pad(seconds)}`;
        }, 1000);
    }

    function calculateScore() {
        return 100; // Puedes ajustar esta lógica si es necesario
    }

    function saveResult(score, minutes, seconds, attempts) {
        const playerData = JSON.parse(sessionStorage.getItem('currentPlayer'));
        if (!playerData || !playerData.name) {
            alert('Error: El nombre del jugador no está disponible.');
            return;
        }

        const jugador = playerData.name;
        const sessionId = playerData.sessionId;

        // Guardar resultados en el localStorage
        let results = JSON.parse(localStorage.getItem('memorama_results')) || [];
        results.push({ sessionId, name: jugador, score, time: minutes * 60 + seconds, attempts });
        if (results.length > 5) {
            results.shift(); // Mantener solo los últimos 5 resultados
        }
        localStorage.setItem('memorama_results', JSON.stringify(results));

        // Actualizar la entrada del jugador actual en sessionStorage
        playerData.memoramaScore = score;
        playerData.memoramaTime = minutes * 60 + seconds;
        sessionStorage.setItem('currentPlayer', JSON.stringify(playerData));

        // Enviar resultados al servidor
        fetch('/store-final-result', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                name: jugador,
                scorememorama: score, // Enviar el puntaje del memorama
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log('Resultados guardados en el servidor:', data);
        })
        .catch(error => {
            console.error('Error al guardar resultados en el servidor:', error);
        });
    }

    viewResultsButton.addEventListener('click', viewResults);

    function viewResults() {
        const playerData = JSON.parse(sessionStorage.getItem('currentPlayer'));
        if (!playerData || !playerData.sessionId) {
            alert('Error: El identificador de sesión no está disponible.');
            return;
        }
        const sessionId = playerData.sessionId;

        const results = JSON.parse(localStorage.getItem('memorama_results')) || [];
        const resultsList = document.getElementById('results-list');
        resultsList.innerHTML = ''; // Limpiar la lista de resultados

        // Filtrar resultados para mostrar solo los del jugador actual
        const playerResults = results.filter(result => result.sessionId === sessionId);

        playerResults.forEach(result => {
            const minutes = Math.floor(result.time / 60);
            const seconds = result.time % 60;
            const timeFormatted = `${pad(minutes)}:${pad(seconds)}`;
            const li = document.createElement('li');
            li.textContent = `Nombre: ${result.name}, Puntuación: ${result.score}, Tiempo: ${timeFormatted}, Intentos: ${result.attempts}`;
            resultsList.appendChild(li);
        });

        resultsModal.style.display = 'flex';
    }

    closeResultsModal.addEventListener('click', function() {
        resultsModal.style.display = 'none';
    });

    window.onclick = function(event) {
        if (event.target == resultsModal) {
            resultsModal.style.display = 'none';
        }
    }

    function pad(value) {
        return value.toString().padStart(2, '0');
    }
});
