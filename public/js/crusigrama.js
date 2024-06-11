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
    const grid = document.getElementById('crucigrama-grid');
    const gridSize = 23;
    let currentDirection = 'horizontal';
    let juegoIniciado = false;
    let timerInterval;
    let totalSeconds = 0;
    let score = 0;
    let attempts = 0;
    const celdasCorrectas = new Set();
    const palabrasEncontradas = new Set();
    const startButton = document.getElementById('IniciarC');
    const attemptsDisplay = document.getElementById('attempts');
    const scoreDisplay = document.getElementById('score');
    const timerDisplay = document.getElementById('timer');
    const viewResultsButton = document.getElementById('viewResultsButton');
    const resultsModal = document.getElementById('resultsModal');
    const closeResultsModal = document.getElementById('closeResultsModal');

    // Configuración para limpiar localStorage cada 40 minutos (2400000 ms)
    setInterval(() => {
        localStorage.clear();
        alert("El almacenamiento local ha sido limpiado automáticamente después de 40 minutos.");
    }, 2400000);

    function habilitarInteraccion() {
        juegoIniciado = true;
        document.querySelectorAll('.crucigrama-cell').forEach(cell => {
            cell.querySelector('input').disabled = false;
        });
    }

    for (let row = 0; row < gridSize; row++) {
        const rowHTML = document.createElement('tr');
        for (let col = 0; col < gridSize; col++) {
            const cell = document.createElement('td');
            const input = document.createElement('input');
            input.type = 'text';
            input.maxLength = 1;
            input.setAttribute('data-row', row);
            input.setAttribute('data-col', col);
            input.classList.add('crucigrama-cell', 'border', 'border-gray-300', 'w-5', 'h-5', 'text-center');
            input.oninput = function() {
                this.value = this.value.toUpperCase();
                if (juegoIniciado) {
                    moveNextCell(this, currentDirection);
                    verificarPalabras();
                }
            };
            input.onkeydown = function(e) {
                if (juegoIniciado) {
                    handleArrowKeys(e, this);
                }
            };
            input.disabled = true;
            const span = document.createElement('span');
            span.classList.add('pista-numero');
            cell.appendChild(span);
            cell.appendChild(input);
            rowHTML.appendChild(cell);
        }
        grid.appendChild(rowHTML);
    }

    const palabras = [
        { palabra: 'SIFILIS', direccion: 'horizontal', fila: 19, columna: 0 },
        { palabra: 'CLAMIDIA', direccion: 'horizontal', fila: 10, columna: 2 },
        { palabra: 'PAPILOMA', direccion: 'horizontal', fila: 1, columna: 15 },
        { palabra: 'CANDIDIASIS', direccion: 'horizontal', fila: 5, columna: 7 },
        { palabra: 'HEPATITIS', direccion: 'horizontal', fila: 14, columna: 0 },
        { palabra: 'HERPES', direccion: 'horizontal', fila: 8, columna: 7 },
        { palabra: 'VIH', direccion: 'horizontal', fila: 17, columna: 0 },
        { palabra: 'SIDA', direccion: 'vertical', fila: 5, columna: 15 },
        { palabra: 'GONORREA', direccion: 'vertical', fila: 3, columna: 9 },
        { palabra: 'ULCERA', direccion: 'vertical', fila: 9, columna: 3 },
        { palabra: 'VPH', direccion: 'vertical', fila: 0, columna: 15 },
        { palabra: 'URETRITIS', direccion: 'vertical', fila: 12, columna: 1 },
        { palabra: 'CONDILOMA', direccion: 'vertical', fila: 0, columna: 20 },
        { palabra: 'PUBIS', direccion: 'vertical', fila: 1, columna: 17 },
    ];

    palabras.forEach(({ palabra, direccion, fila, columna }, index) => {
        for (let i = 0; i < palabra.length; i++) {
            const currentRow = direccion === 'horizontal' ? fila : fila + i;
            const currentCol = direccion === 'horizontal' ? columna + i : columna;
            const cellSelector = `input[data-row="${currentRow}"][data-col="${currentCol}"]`;
            const inputCell = document.querySelector(cellSelector);

            inputCell.disabled = false;
            inputCell.setAttribute('data-direction', direccion);
            if (i === 0) {
                const span = inputCell.previousElementSibling;
                span.textContent = index + 1;
            }
        }
    });

    startButton.addEventListener('click', function() {
        startButton.style.display = 'none';
        iniciarCronometro();
        habilitarInteraccion();
    });

    function moveNextCell(currentInput, direction) {
        const row = parseInt(currentInput.getAttribute('data-row'));
        const col = parseInt(currentInput.getAttribute('data-col'));

        let nextInput;
        if (direction === 'horizontal') {
            nextInput = document.querySelector(`input[data-row="${row}"][data-col="${col + 1}"]`);
        } else if (direction === 'vertical') {
            nextInput = document.querySelector(`input[data-row="${row + 1}"][data-col="${col}"]`);
        }

        if (nextInput && !nextInput.disabled) {
            nextInput.focus();
        }
    }

    function handleArrowKeys(e, currentInput) {
        const row = parseInt(currentInput.getAttribute('data-row'));
        const col = parseInt(currentInput.getAttribute('data-col'));

        switch (e.key) {
            case 'ArrowUp':
                if (row > 0) {
                    const upInput = document.querySelector(`input[data-row="${row - 1}"][data-col="${col}"]`);
                    if (upInput && !upInput.disabled) {
                        upInput.focus();
                    }
                }
                break;
            case 'ArrowDown':
                if (row < 22) {
                    const downInput = document.querySelector(`input[data-row="${row + 1}"][data-col="${col}"]`);
                    if (downInput && !downInput.disabled) {
                        downInput.focus();
                    }
                }
                break;
            case 'ArrowLeft':
                if (col > 0) {
                    const leftInput = document.querySelector(`input[data-row="${row}"][data-col="${col - 1}"]`);
                    if (leftInput && !leftInput.disabled) {
                        leftInput.focus();
                    }
                }
                break;
            case 'ArrowRight':
                if (col < 22) {
                    const rightInput = document.querySelector(`input[data-row="${row}"][data-col="${col + 1}"]`);
                    if (rightInput && !rightInput.disabled) {
                        rightInput.focus();
                    }
                }
                break;
        }
    }

    function iniciarCronometro() {
        timerInterval = setInterval(function() {
            totalSeconds++;
            const minutes = Math.floor(totalSeconds / 60);
            const seconds = totalSeconds % 60;
            timerDisplay.textContent = `${minutes < 10 ? '0' : ''}${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
        }, 1000);
    }

    function detenerCronometro() {
        clearInterval(timerInterval);
    }

    function verificarPalabras() {
        let todasCompletadas = true;

        palabras.forEach(({ palabra, direccion, fila, columna }) => {
            let palabraUsuario = '';
            let palabraCompleta = true;

            for (let i = 0; i < palabra.length; i++) {
                const currentRow = direccion === 'horizontal' ? fila : fila + i;
                const currentCol = direccion === 'horizontal' ? columna + i : columna;
                const cellSelector = `input[data-row="${currentRow}"][data-col="${currentCol}"]`;
                const inputCell = document.querySelector(cellSelector);
                palabraUsuario += inputCell.value;

                if (!inputCell.value || inputCell.value.toUpperCase() !== palabra[i]) {
                    palabraCompleta = false;
                    todasCompletadas = false;
                }
            }

            if (palabraCompleta && palabraUsuario.toUpperCase() === palabra && !palabrasEncontradas.has(palabra)) {
                score += 100;
                scoreDisplay.textContent = score;
                palabrasEncontradas.add(palabra);

                for (let i = 0; i < palabra.length; i++) {
                    const currentRow = direccion === 'horizontal' ? fila : fila + i;
                    const currentCol = direccion === 'horizontal' ? columna + i : columna;
                    celdasCorrectas.add(`${currentRow}-${currentCol}`);
                }
            }
        });

        palabras.forEach(({ palabra, direccion, fila, columna }) => {
            marcarPalabra(fila, columna, palabra.length, direccion, palabra);
        });

        if (todasCompletadas && palabrasEncontradas.size === palabras.length) {
            marcarTodasCeldasVerde();
            detenerCronometro();

            alert("¡Has encontrado todas las palabras!");
            // Guardar resultados en localStorage
            const playerName = localStorage.getItem('playerName');
            if (!playerName) {
                alert('Error: El nombre del jugador no está disponible.');
                return;
            }
            saveResult(playerName, score, totalSeconds);
        }

        attempts++;
        attemptsDisplay.textContent = attempts;
    }

    function marcarPalabra(fila, columna, longitud, direccion, palabra) {
        for (let i = 0; i < longitud; i++) {
            const currentRow = direccion === 'horizontal' ? fila : fila + i;
            const currentCol = direccion === 'horizontal' ? columna + i : columna;
            const cellSelector = `input[data-row="${currentRow}"][data-col="${currentCol}"]`;
            const inputCell = document.querySelector(cellSelector);

            if (celdasCorrectas.has(`${currentRow}-${currentCol}`)) {
                inputCell.style.backgroundColor = '#8dcf88';
                inputCell.disabled = true;
            } else {
                inputCell.style.backgroundColor = '#ff6464';
            }
        }
    }

    function marcarTodasCeldasVerde() {
        document.querySelectorAll('.crucigrama-cell input').forEach(input => {
            input.style.backgroundColor = '#8dcf88';
            input.disabled = true;
        });
    }

    function saveResult(name, score, time) {
        let results = JSON.parse(localStorage.getItem('crucigrama_results')) || [];
        results.push({ name, score, time, attempts });
        if (results.length > 5) {
            results.shift(); // Mantener solo los últimos 5 resultados
        }
        localStorage.setItem('crucigrama_results', JSON.stringify(results));
    }

    viewResultsButton.addEventListener('click', viewResults);

    function viewResults() {
        const results = JSON.parse(localStorage.getItem('crucigrama_results')) || [];
        const resultsList = document.getElementById('results-list');
        resultsList.innerHTML = ''; // Limpiar la lista de resultados

        results.forEach(result => {
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
    };
    function pad(value) {
        return value.toString().padStart(2, '0');
    };
});
