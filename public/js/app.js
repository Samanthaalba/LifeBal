/////////////////////////////////////////////////////////////////////////
// Logica del login para que el usuario no pueda entrar al inicio sin antes poner un nombre
/////////////////////////////////////////////////////////////////////////
document.addEventListener("DOMContentLoaded", function() {
    const loginBtn = document.getElementById('loginBtn');
    const viewPlayersBtn = document.getElementById('viewPlayersBtn');
    const playersModal = document.getElementById('playersModal');
    const closeModal = document.querySelector('.modal .close');
    const downloadCsvBtn = document.getElementById('downloadCsvBtn');

    function generateSessionId() {
        return '_' + Math.random().toString(36).substr(2, 9);
    }

    // Lógica para iniciar sesión
    loginBtn.addEventListener('click', function() {
        const playerName = document.getElementById('UserName').value.trim();
        if (playerName === '') {
            alert('Por favor, ingresa un nombre.');
            return;
        }

        const sessionId = generateSessionId();
        const timestamp = new Date().toISOString();

        const entry = { name: playerName, timestamp: timestamp, sessionId: sessionId };

        // Guardar el jugador actual en sessionStorage
        sessionStorage.setItem('currentPlayer', JSON.stringify(entry));

        // Guardar la sesión actual en localStorage
        let entries = JSON.parse(localStorage.getItem('players')) || [];
        entries.push(entry);
        localStorage.setItem('players', JSON.stringify(entries));

        // Redirigir al usuario a la página de inicio
        window.location.href = '/inicio';
    });

    // Abrir el modal de jugadores con autenticación
    viewPlayersBtn.addEventListener('click', function() {
        const password = prompt('Por favor, ingrese la contraseña para acceder al informe de los jugadores:');
        if (password === 'admin2024') {
            playersModal.style.display = 'flex';
        } else {
            alert('Contraseña incorrecta. Intente nuevamente.');
        }
    });

    // Cerrar el modal de jugadores
    closeModal.addEventListener('click', function() {
        playersModal.style.display = 'none';
    });

    // Cerrar el modal si se hace clic fuera del mismo
    window.addEventListener('click', function(event) {
        if (event.target == playersModal) {
            playersModal.style.display = 'none';
        }
    });

    // Descargar CSV
    downloadCsvBtn.addEventListener('click', function() {
        window.location.href = '/download-results';
    });
    

    // Verifica si hay un jugador al acceder a las rutas de los juegos
    const playerData = JSON.parse(sessionStorage.getItem('currentPlayer'));
    if (!playerData || !playerData.name) {
        if (window.location.pathname !== '/') { // Solo redirigir si no está en la página principal
            alert('Debe ingresar un nombre en la página de inicio para continuar.');
            window.location.href = '/';
        }
    }
});

/* /////////////////////////////////////////////////////////
// Logica para el carrusel
///////////////////////////////////////////////////////// */
document.addEventListener("DOMContentLoaded", function() {
    const correctPassword = 'admin2024';
    const cards = document.querySelectorAll(".card");

    cards.forEach(card => {
        card.addEventListener("click", function() {
            const isChecked = card.getAttribute("for") === document.querySelector("input[name='slider']:checked").id;
            if (isChecked) {
                window.location.href = card.getAttribute("data-link");
            }
        });
    });

    fetch('/visit-count')  // Ruta que devuelve el número de visitas
    .then(response => response.json())
    .then(data => {
        // Actualiza el contenido del contador en la página
        document.getElementById('visit-count').textContent = data.visitCount;
    })
    .catch(error => console.error('Error al obtener el contador de visitas:', error));

    // Mostrar el contador de visitas en la página
    const visitCountElement = document.getElementById('visit-count');
    visitCountElement.textContent = localStorage.getItem('visitCount');

    const playerData = JSON.parse(sessionStorage.getItem('currentPlayer'));
    if (!playerData || !playerData.name) {
        alert('Debe ingresar un nombre en la página de inicio para continuar.');
        window.location.href = '/';
        return;
    }

    var instructionsModal = document.getElementById('instructions-modal');
    var closeModal = document.querySelector('.close');
    var closeInstructions = document.getElementById('closeInstructions');

    // Mostrar el modal de instrucciones al cargar la página
    instructionsModal.style.display = 'flex';

    // Cerrar el modal cuando se haga clic en el botón de cerrar
    closeModal.onclick = function() {
        instructionsModal.style.display = 'none';
    };

    // Cerrar el modal cuando se haga clic en el botón de cerrar instrucciones
    closeInstructions.onclick = function() {
        instructionsModal.style.display = 'none';
    };

    // Cerrar el modal cuando se haga clic fuera del mismo
    window.onclick = function(event) {
        if (event.target == instructionsModal) {
            instructionsModal.style.display = 'none';
        }
    };
});
