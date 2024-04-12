/*
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
CRUSIGRAMA
//////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
*/

document.addEventListener('DOMContentLoaded', function() {
    const grid = document.getElementById('crucigrama-grid');
    const gridSize = 23; // Dimensiones de la grilla del crucigrama

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
            input.oninput = function() { this.value = this.value.toUpperCase(); };
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
// ... ( palabras y posiciones aquí)
// Palabras horizontales
{ palabra: 'SIFILIS', direccion: 'horizontal', fila: 19, columna: 0 },
{ palabra: 'CLAMIDIA', direccion: 'horizontal', fila: 10, columna: 2 },//
{ palabra: 'PAPILOMA', direccion: 'horizontal', fila: 1, columna: 15 },
{ palabra: 'CANDIDIASIS', direccion: 'horizontal', fila: 5, columna: 7 },//
{ palabra: 'HEPATITIS', direccion: 'horizontal', fila: 14, columna: 0 },
{ palabra: 'HERPES', direccion: 'horizontal', fila: 8, columna: 7 },//
{ palabra: 'VIH', direccion: 'horizontal', fila:17, columna: 0 },//

// Palabras verticales
{ palabra: 'SIDA', direccion: 'vertical', fila: 5, columna: 15 },//
{ palabra: 'GONORREA', direccion: 'vertical', fila: 3, columna: 9 },//
{ palabra: 'ULCERA', direccion: 'vertical', fila: 9, columna: 3 },
{ palabra: 'VPH', direccion: 'vertical', fila: 0, columna: 15 },//
{ palabra: 'URETRITIS', direccion: 'vertical', fila: 12, columna: 1 },
{ palabra: 'CONDILOMA', direccion: 'vertical', fila: 1, columna: 13 },
{ palabra: 'PUBIS', direccion: 'vertical', fila: 1, columna: 17 },//
];

palabras.forEach(({ palabra, direccion, fila, columna }, index) => {
        for (let i = 0; i < palabra.length; i++) {
            const currentRow = direccion === 'horizontal' ? fila : fila + i;
            const currentCol = direccion === 'horizontal' ? columna + i : columna;
            const cellSelector = `input[data-row="${currentRow}"][data-col="${currentCol}"]`;
            const inputCell = document.querySelector(cellSelector);

            inputCell.disabled = false;
            if (i === 0) { // Solo en el inicio de cada palabra
                const span = inputCell.previousElementSibling;
                span.textContent = index + 1; // Número de la pista
            }
        }
    });
});

function verificarPalabras() {
    const palabras = [
        // se repite aquí la definición de las palabras para hacer la verificacion
        { palabra: 'SIFILIS', direccion: 'horizontal', fila: 19, columna: 0 },
        { palabra: 'CLAMIDIA', direccion: 'horizontal', fila: 10, columna: 2 },//
        { palabra: 'PAPILOMA', direccion: 'horizontal', fila: 1, columna: 15 },
        { palabra: 'CANDIDIASIS', direccion: 'horizontal', fila: 5, columna: 7 },//
        { palabra: 'HEPATITIS', direccion: 'horizontal', fila: 14, columna: 0 },
        { palabra: 'HERPES', direccion: 'horizontal', fila: 8, columna: 7 },//
        { palabra: 'VIH', direccion: 'horizontal', fila:17, columna: 0 },//
        
        // Palabras verticales
        { palabra: 'SIDA', direccion: 'vertical', fila: 5, columna: 15 },//
        { palabra: 'GONORREA', direccion: 'vertical', fila: 3, columna: 9 },//
        { palabra: 'ULCERA', direccion: 'vertical', fila: 9, columna: 3 },
        { palabra: 'VPH', direccion: 'vertical', fila: 0, columna: 15 },//
        { palabra: 'URETRITIS', direccion: 'vertical', fila: 12, columna: 1 },
        { palabra: 'CONDILOMA', direccion: 'vertical', fila: 1, columna: 13 },
        { palabra: 'PUBIS', direccion: 'vertical', fila: 1, columna: 17 },//
    ];
    let espaciosLlenados = 0;
const totalEspacios = palabras.reduce((acum, {palabra}) => acum + palabra.length, 0);

document.querySelectorAll('input.crucigrama-cell').forEach(input => {
if (input.value !== '') espaciosLlenados++;
});

// Solo proceder con la verificación si todos los espacios han sido llenados
if (espaciosLlenados === totalEspacios) {
const colores = ['#FFD700', '#FF8C00', '#1E90FF', '#32CD32', '#FF69B4', '#BA55D3', '#F08080', '#00FA9A', '#F4A460', '#2E8B57'];
palabras.forEach(({ palabra, direccion, fila, columna }, index) => {
    let palabraUsuario = '';
    for (let i = 0; i < palabra.length; i++) {
        const currentRow = direccion === 'horizontal' ? fila : fila + i;
        const currentCol = direccion === 'horizontal' ? columna + i : columna;
        const cellSelector = `input[data-row="${currentRow}"][data-col="${currentCol}"]`;
        const inputCell = document.querySelector(cellSelector);
        palabraUsuario += inputCell.value;
    }
    if (palabraUsuario.toUpperCase() === palabra) {
        const color = colores[index % colores.length];
        marcarPalabraEncontrada(fila, columna, palabra.length, direccion, color);
    }
});
} else {
alert('Por favor, completa todos los espacios antes de verificar.');
}
}

function marcarPalabraEncontrada(fila, columna, longitud, direccion, color) {
    for (let i = 0; i < longitud; i++) {
        const currentRow = direccion === 'horizontal' ? fila : fila + i;
        const currentCol = direccion === 'horizontal' ? columna + i : columna;
        const cellSelector = `input[data-row="${currentRow}"][data-col="${currentCol}"]`;
        const inputCell = document.querySelector(cellSelector);
        inputCell.style.backgroundColor = color;
        inputCell.disabled = true; // Deshabilita la celda para que no pueda ser editada
    }
}
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
        }
        // Si sinCambios es verdadero, el evento sigue adelante y regresa al inicio sin problemas
    });
});
