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

    const playerData = JSON.parse(sessionStorage.getItem('currentPlayer'));
    if (!playerData || !playerData.name) {
        alert('Debe ingresar un nombre en la página de inicio para continuar.');
        window.location.href = '/'; // Redirigir al inicio si no hay nombre
        return;
    }
});

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
    let gameStarted = false;
    let colorIndex = 0;

    const colores = ['letra-encontrada-rosa', 'letra-encontrada-azul', 'letra-encontrada-rojo', 'letra-encontrada-amarillo'];
    const palabrasValidas = [
        'CUIDADO', 'ADOLESCENCIA', 'FAMILIA', 'ENFERMEDADES', 'ORIENTACION', 'EMBARAZO', 
        'ANTICONCEPTIVO', 'EDUCACION', 'SALUD', 'PREVENCION', 'SEXUALIDAD', 'RESPONSABILIDAD', 
        'INFORMACION', 'APOYO', 'RESPETO', 'COMUNICACION'
    ].map(palabra => palabra.toUpperCase());

    const letras = document.querySelectorAll('.letra');
    const startButton = document.getElementById('startButton1');
    const otraVez = document.getElementById('otraVez');
    const attemptsDisplay = document.getElementById('attempts');
    const scoreDisplay = document.getElementById('score');
    const timerDisplay = document.getElementById('timer');
    const viewResultsButton = document.getElementById('viewResultsButton');
    const resultsModal = document.getElementById('resultsModal');
    const closeResultsModal = document.getElementById('closeResultsModal');

    // Configuración para limpiar localStorage cada 40 minutos (2400000 ms)
    setInterval(() => {
        localStorage.clear();
        alert("El almacenamiento local ha sido limpiado automáticamente después de 1 hora.");
    }, 3600000);

    startButton.addEventListener('click', startGame);

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

    function startGame() {
        attempts = 0;
        score = 0;
        foundWords = 0;
        totalSeconds = 0;
        gameEnded = false;
        gameStarted = true;
        colorIndex = 0;

        attemptsDisplay.textContent = attempts;
        scoreDisplay.textContent = score;
        timerDisplay.textContent = '00:00';
        startButton.style.display = 'none';

        letras.forEach(letra => letra.classList.remove('letra-seleccionada', ...colores));
        document.querySelectorAll('.palabra').forEach(palabra => palabra.classList.remove('palabra-encontrada-tachada'));

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
            const colorClase = obtenerColorEnOrden();
            seleccionActual.forEach(letra => letra.classList.add(colorClase));
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

        // Asegurarse de que el nombre del jugador esté en sessionStorage
        const playerData = JSON.parse(sessionStorage.getItem('currentPlayer'));
        if (!playerData || !playerData.name) {
            alert('Error: El nombre del jugador no está disponible.');
            return;
        }
        const jugador = playerData.name;
        const sessionId = playerData.sessionId;

        // Guardar en localStorage
        saveResult(sessionId, jugador, score, totalSeconds, attempts);
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
            palabraElemento.classList.add('palabra-encontrada-tachada');
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

    function obtenerColorEnOrden() {
        const colorClase = colores[colorIndex];
        colorIndex = (colorIndex + 1) % colores.length;
        return colorClase;
    }

    function saveResult(sessionId, name, score, time, attempts) {
        let results = JSON.parse(localStorage.getItem('sopa_results')) || [];
        results.push({ sessionId, name, score, time, attempts, timestamp: new Date().toISOString() });
        if (results.length > 5) {
            results.shift(); // Mantener solo los últimos 5 resultados
        }
        localStorage.setItem('sopa_results', JSON.stringify(results));

        // Actualizar la entrada del jugador actual en sessionStorage
        const currentPlayer = JSON.parse(sessionStorage.getItem('currentPlayer'));
        currentPlayer.sopaDeLetrasScore = score;
        currentPlayer.sopaDeLetrasTime = time;
        sessionStorage.setItem('currentPlayer', JSON.stringify(currentPlayer));

        // Enviar los resultados al servidor
        fetch('/store-final-result', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                name: name, 
                scoresopa: score // Solo enviar el nombre y el scoresopa
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log('Resultados guardados en el servidor:', data);
        })
        .catch(error => {
            console.error('Error al guardar resultados en el servidor:', error);
        });       

        // Actualizar la entrada del jugador en localStorage
        let players = JSON.parse(localStorage.getItem('players')) || [];
        let playerIndex = players.findIndex(player => player.sessionId === sessionId);
        if (playerIndex !== -1) {
            players[playerIndex].sopaDeLetrasScore = score;
            players[playerIndex].sopaDeLetrasTime = time;
        } else {
            players.push(currentPlayer);
        }
        localStorage.setItem('players', JSON.stringify(players));
    }


    viewResultsButton.addEventListener('click', viewResults);

    function viewResults() {
        const playerData = JSON.parse(sessionStorage.getItem('currentPlayer'));
        if (!playerData || !playerData.sessionId) {
            alert('Error: El identificador de sesión no está disponible.');
            return;
        }
        const sessionId = playerData.sessionId;

        const results = JSON.parse(localStorage.getItem('sopa_results')) || [];
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
});
