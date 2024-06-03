////////////////////////////////////////////////////////////////////////////////
///Sopa de letras 
////////////////////////////////////////////////////////////////////////////////
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
        gameStarted = true;
        colorIndex = 0;

        attemptsDisplay.textContent = attempts;
        scoreDisplay.textContent = score;
        timerDisplay.textContent = '00:00';

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
    
                // Guardar resultados en localStorage
                localStorage.setItem('sopa_score', score);
                localStorage.setItem('sopa_time', totalSeconds);
    
                // Verificar si todos los juegos están completos
                if (localStorage.getItem('quiz_score') && localStorage.getItem('memorama_score') && localStorage.getItem('sopa_score') && localStorage.getItem('crucigrama_score')) {
                    guardarResultadosTotales();
                } else {
                    alert('Juego terminado, pero aún faltan otros juegos por completar.');
                }
            }
        } else {
            limpiarSeleccionActual();
        }
    }
    

    function stopGame() {
        clearInterval(timerInterval);
        gameEnded = true;
        alert("¡Has encontrado todas las palabras!");

        // Guardar en localStorage
        localStorage.setItem('sopa_score', score);
        localStorage.setItem('sopa_time', totalSeconds);

        // Verificar si todos los juegos están completos
        if (localStorage.getItem('quiz_score') && localStorage.getItem('memorama_score') && localStorage.getItem('crucigrama_score')) {
            guardarResultadosTotales();
        } else {
            alert('Juego terminado, pero aún faltan otros juegos por completar.');
        }
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

    const gameName = 'sopa_letras';

    function guardarResultadosTotales() {
        const totalScore = parseInt(localStorage.getItem('quiz_score')) + parseInt(localStorage.getItem('memorama_score')) + parseInt(localStorage.getItem('sopa_score')) + parseInt(localStorage.getItem('crucigrama_score'));
        const totalTime = parseInt(localStorage.getItem('quiz_time')) + parseInt(localStorage.getItem('memorama_time')) + parseInt(localStorage.getItem('sopa_time')) + parseInt(localStorage.getItem('crucigrama_time'));
        const playerName = localStorage.getItem('playerName');

        fetch('/save-result/totales', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                game_name: 'total',
                score: totalScore,
                time: totalTime,
                user_name: playerName
            })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            localStorage.removeItem('quiz_score');
            localStorage.removeItem('quiz_time');
            localStorage.removeItem('memorama_score');
            localStorage.removeItem('memorama_time');
            localStorage.removeItem('sopa_score');
            localStorage.removeItem('sopa_time');
            localStorage.removeItem('crucigrama_score');
            localStorage.removeItem('crucigrama_time');
            window.location.href = "/inicio";
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al guardar los resultados totales.');
        });
    }
});
