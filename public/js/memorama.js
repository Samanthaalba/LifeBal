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
            score += calculateScore();
            document.getElementById('score').textContent = score;
            disableCards();

            if (document.querySelectorAll('.flipped').length === cards.length) {
                clearInterval(interval);
                alert("¡Has encontrado todas las parejas!");

                // Guardar resultados en localStorage
                localStorage.setItem('memorama_score', score);
                localStorage.setItem('memorama_time', (minutes * 60) + seconds);
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
        }, 300000);//timepo de ver las cartas antes de empezar

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

    function calculateScore() {
        return 100; // Puedes ajustar esta función según sea necesario
    }

    const gameName = 'memorama';

    function guardarResultadosTotales() {
        const totalScore = parseInt(localStorage.getItem('quiz_score')) + 
                           parseInt(localStorage.getItem('memorama_score')) + 
                           parseInt(localStorage.getItem('sopa_score')) + 
                           parseInt(localStorage.getItem('crucigrama_score'));
        const totalTime = parseInt(localStorage.getItem('quiz_time')) + 
                          parseInt(localStorage.getItem('memorama_time')) + 
                          parseInt(localStorage.getItem('sopa_time')) + 
                          parseInt(localStorage.getItem('crucigrama_time'));
        const playerName = localStorage.getItem('playerName');
    
        if (isNaN(totalScore) || isNaN(totalTime) || !playerName) {
            alert('Error: Faltan datos para guardar los resultados totales. Asegúrate de haber completado todos los juegos.');
            return;
        }
    
        fetch('/store-final-result', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                game_name: gameName,
                user_name: playerName,
                total_score: totalScore,
                total_time: totalTime
            })
        })
        .then(response => response.text()) // Captura la respuesta como texto
        .then(text => {
            console.log(text); // Muestra la respuesta del servidor
            let data;
            try {
                data = JSON.parse(text); // Intenta convertir la respuesta a JSON
            } catch (e) {
                throw new Error('La respuesta no es un JSON válido: ' + text);
            }
    
            if (data.error) {
                throw new Error(data.error);
            }
            alert(data.message);
            localStorage.clear();
            window.location.href = "/inicio";
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al guardar los resultados totales: ' + error.message);
        });
    }
    
});
