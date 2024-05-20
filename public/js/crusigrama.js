/*
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
CRUSIGRAMA
//////////////////////////////////////////////////////////////////////////////////////////////////////////
Correccion de verificacion de palabras suma los puntos mal
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
*/
document.addEventListener('DOMContentLoaded', function() {
    const grid = document.getElementById('crucigrama-grid');
    const gridSize = 23; // Dimensiones de la grilla del crucigrama
    let currentDirection = 'horizontal';
    let juegoIniciado = false; // Variable para rastrear si el juego ha sido iniciado
    let timerInterval; // Variable para almacenar el intervalo del cronómetro
    let tiempo = 0; // Variable para almacenar el tiempo transcurrido en segundos
    let puntuacion = 0; // Variable para almacenar la puntuación
    let intentos = 0; // Variable para almacenar el número de intentos

    for (let row = 0; row < gridSize; row++) {
        const rowHTML = document.createElement('tr');
        for (let col = 0; col < gridSize; col++) {
            const cell = document.createElement('td');
            const input = document.createElement('input');
            input.type = 'text';
            input.maxLength = 1;
            input.setAttribute('data-row', row);
            input.setAttribute('data-col', col);
            input.classList.add('crucigrama-cell');
            input.oninput = function() {
                this.value = this.value.toUpperCase();
                moveNextCell(this, currentDirection);
            };
            input.onkeydown = function(e) {
                handleArrowKeys(e, this);
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

    // Define las palabras para el crucigrama con sus posiciones y orientación
    const palabras = [
        // Palabras horizontales
        { palabra: 'SIFILIS', direccion: 'horizontal', fila: 19, columna: 0 },
        { palabra: 'CLAMIDIA', direccion: 'horizontal', fila: 10, columna: 2 },
        { palabra: 'PAPILOMA', direccion: 'horizontal', fila: 1, columna: 15 },
        { palabra: 'CANDIDIASIS', direccion: 'horizontal', fila: 5, columna: 7 },
        { palabra: 'HEPATITIS', direccion: 'horizontal', fila: 14, columna: 0 },
        { palabra: 'HERPES', direccion: 'horizontal', fila: 8, columna: 7 },
        { palabra: 'VIH', direccion: 'horizontal', fila: 17, columna: 0 },
        
        // Palabras verticales
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
            if (i === 0) { // Solo en el inicio de cada palabra
                const span = inputCell.previousElementSibling;
                span.textContent = index + 1; // Número de la pista
            }
        }
    });

         // Función para manejar el evento de clic en el botón "Iniciar"
    document.getElementById('IniciarC').addEventListener('click', function() {
        iniciarCronometro();
        juegoIniciado = true;
        // Habilitar la edición de las celdas al presionar "Iniciar"
        document.querySelectorAll('.crucigrama-cell').forEach(cell => {
            cell.querySelector('input').disabled = false;
        });
    });
    // Función para manejar el evento de clic en el botón "Verificar"
    document.getElementById('VerificarC').addEventListener('click', function() {
        verificarPalabras();
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
            tiempo++;
            const minutes = Math.floor(tiempo / 60);
            const seconds = tiempo % 60;
            document.getElementById('tiempo').textContent = `${minutes < 10 ? '0' : ''}${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
        }, 1000);
    }

    function detenerCronometro() {
        clearInterval(timerInterval);
    }   

    function verificarPalabras() {
        const palabras = [
            // se repite aquí la definición de las palabras para hacer la verificacion
            { palabra: 'SIFILIS', direccion: 'horizontal', fila: 19, columna: 0 },
            { palabra: 'CLAMIDIA', direccion: 'horizontal', fila: 10, columna: 2 },
            { palabra: 'PAPILOMA', direccion: 'horizontal', fila: 1, columna: 15 },
            { palabra: 'CANDIDIASIS', direccion: 'horizontal', fila: 5, columna: 7 },
            { palabra: 'HEPATITIS', direccion: 'horizontal', fila: 14, columna: 0 },
            { palabra: 'HERPES', direccion: 'horizontal', fila: 8, columna: 7 },
            { palabra: 'VIH', direccion: 'horizontal', fila: 17, columna: 0 },
            
            // Palabras verticales
            { palabra: 'SIDA', direccion: 'vertical', fila: 5, columna: 15 },
            { palabra: 'GONORREA', direccion: 'vertical', fila: 3, columna: 9 },
            { palabra: 'ULCERA', direccion: 'vertical', fila: 9, columna: 3 },
            { palabra: 'VPH', direccion: 'vertical', fila: 0, columna: 15 },
            { palabra: 'URETRITIS', direccion: 'vertical', fila: 12, columna: 1 },
            { palabra: 'CONDILOMA', direccion: 'vertical', fila: 0, columna: 20 },
            { palabra: 'PUBIS', direccion: 'vertical', fila: 1, columna: 17 },
        ];

        const celdasCorrectas = new Set();
    let todasCompletadas = true; // Variable para controlar si todas las palabras han sido completadas

    palabras.forEach(({ palabra, direccion, fila, columna }) => {
        let palabraUsuario = '';
        for (let i = 0; i < palabra.length; i++) {
            const currentRow = direccion === 'horizontal' ? fila : fila + i;
            const currentCol = direccion === 'horizontal' ? columna + i : columna;
            const cellSelector = `input[data-row="${currentRow}"][data-col="${currentCol}"]`;
            const inputCell = document.querySelector(cellSelector);
            palabraUsuario += inputCell.value;

            // Verificar si alguna celda está vacía, si lo está, no todas las palabras han sido completadas
            if (!inputCell.value) {
                todasCompletadas = false;
            }
        }

        if (palabraUsuario.toUpperCase() === palabra) {
            // Ajustar la puntuación según el tiempo transcurrido
            if (tiempo <= 10) {
                puntuacion += 100;
            } else if (tiempo <= 20) {
                puntuacion += 90;
            } else if (tiempo <= 30) {
                puntuacion += 80;
            } else {
                puntuacion += 70;
            }

            document.getElementById('puntaje').textContent = puntuacion;
            for (let i = 0; i < palabra.length; i++) {
                const currentRow = direccion === 'horizontal' ? fila : fila + i;
                const currentCol = direccion === 'horizontal' ? columna + i : columna;
                celdasCorrectas.add(`${currentRow}-${currentCol}`);
            }
        }
    });

    palabras.forEach(({ palabra, direccion, fila, columna }) => {
        marcarPalabra(fila, columna, palabra.length, direccion, palabra, celdasCorrectas);
    });

    intentos++; // Aumentar el número de intentos
    document.getElementById('intentos').textContent = intentos;

    // Si todas las palabras han sido completadas, detener el cronómetro
    if (todasCompletadas) {
        detenerCronometro();
    }
}
    // Función para marcar la palabra correctamente respondida
    function marcarPalabra(fila, columna, longitud, direccion, palabraCorrecta, celdasCorrectas) {
        for (let i = 0; i < longitud; i++) {
            const currentRow = direccion === 'horizontal' ? fila : fila + i;
            const currentCol = direccion === 'horizontal' ? columna + i : columna;
            const cellSelector = `input[data-row="${currentRow}"][data-col="${currentCol}"]`;
            const inputCell = document.querySelector(cellSelector);
            const esCorrecta = celdasCorrectas.has(`${currentRow}-${currentCol}`);

            if (esCorrecta) {
                inputCell.style.backgroundColor = '#74ee7e';
                inputCell.disabled = true;
            } else {
                inputCell.style.backgroundColor = '#ff13137d';
            }
        }
    }

    //solo para el boton regresar evitar regresar si hay contenido en el juego
    document.addEventListener('DOMContentLoaded', function() {
        const btnRegresar = document.getElementById('btn-regresar');

        btnRegresar.addEventListener('click', function(event) {
            const inputs = document.querySelectorAll('input.crucigrama-cell');
            let sinCambios = true;

            for (let input of inputs) {
                if (input.value !== '') {
                    sinCambios = false;
                    break;
                }
            }
            if (!sinCambios) {
                const confirmacion = confirm('Tienes cambios sin guardar. ¿Seguro que quieres salir?');
                if (!confirmacion) {
                    event.preventDefault(); // Impide la acción predeterminada del botón (navegación)
                }
            }// Si sinCambios es verdadero, el evento sigue adelante y regresa al inicio sin problemas
        });
    });
});   
    document.addEventListener('DOMContentLoaded', function () {
        var pistaButton = document.getElementById('pistaButton');
        var pistaList = document.getElementById('pistaList');

        pistaButton.addEventListener('click', function () {
            pistaList.style.display = 'block';

            setTimeout(function () {
                pistaList.style.display = 'none';
            }, 10000); // Hide after 10 seconds
        });
    }); 