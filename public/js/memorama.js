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
        }, 4000);

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

    const gameName = 'memorama'; // Nombre del juego específico

    document.getElementById('endGameButton').addEventListener('click', function() {
        const score = document.getElementById('score').innerText;
        const time = document.getElementById('timer').innerText;

        fetch('/save-result/memorama', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                game_name: gameName,
                score: parseInt(score),
                time: convertTimeToSeconds(time)
            })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            window.location.href = "/inicio";
        })
        .catch(error => console.error('Error:', error));
    });

    function convertTimeToSeconds(time) {
        const [minutes, seconds] = time.split(':').map(Number);
        return minutes * 60 + seconds;
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