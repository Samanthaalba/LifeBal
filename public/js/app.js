/////////////////////////////////////////////////////////////////////////
// Logica del loguin para que el usuario no pueda entrar al inicio sin antes poner un nombre
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

    loginBtn.addEventListener('click', function() {
        const playerName = document.getElementById('UserName').value.trim();
        if (playerName === '') {
            alert('Por favor, ingresa un nombre.');
            return;
        }

        const sessionId = generateSessionId();
        const timestamp = new Date().toISOString();

        const entry = { name: playerName, timestamp: timestamp, sessionId: sessionId };

        // Guardar en sessionStorage en lugar de localStorage para evitar conflictos de pestañas
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
           // downloadCsvBtn.style.display = 'block'; // Mostrar botón de descargar CSV
            document.getElementById('playerList').style.display = 'none'; // Ocultar tabla
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
        downloadCSV();
    });

    function downloadCSV() {
        let players = JSON.parse(localStorage.getItem('players')) || [];
        if (players.length === 0) {
            alert('No hay jugadores registrados para descargar.');
            return;
        }

        const csvContent = "data:text/csv;charset=utf-8," + 
            "Nombre,Fecha de Ingreso,Hora de ingreso,Puntuación Quiz,Tiempo Quiz,Puntuación Memorama,Tiempo Memorama,Puntuación Sopa,Tiempo Sopa,Puntuación Crucigrama,Tiempo Crucigrama\n" +
            players.map(p => `${p.name},${new Date(p.timestamp).toLocaleString()},${p.quizScore || ''},${p.quizTime || ''},${p.memoramaScore || ''},${p.memoramaTime || ''},${p.sopaDeLetrasScore || ''},${p.sopaDeLetrasTime || ''},${p.crucigramaScore || ''},${p.crucigramaTime || ''}`).join("\n");

        const encodedUri = encodeURI(csvContent);
        const link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "jugadores.csv");
        document.body.appendChild(link); // Required for FF

        link.click();
        document.body.removeChild(link);
    }
});


/* /////////////////////////////////////////////////////////
//////////
/////////    Logioca para el carrusel
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

      // Verificar si la sesión actual ya ha sido contada
      if (!sessionStorage.getItem('sessionCounted')) {
        // Incrementar el contador de visitas
        let visitCount = localStorage.getItem('visitCount');
        if (visitCount === null) {
            visitCount = 0;
        } else {
            visitCount = parseInt(visitCount);
        }
        visitCount++;
        localStorage.setItem('visitCount', visitCount);

        // Marcar la sesión como contada
        sessionStorage.setItem('sessionCounted', 'true');
    }

    // Mostrar el contador de visitas en la página
    const visitCountElement = document.getElementById('visit-count');
    visitCountElement.textContent = localStorage.getItem('visitCount');

    const playerData = JSON.parse(sessionStorage.getItem('currentPlayer'));
    if (!playerData || !playerData.name) {
        alert('Debe ingresar un nombre en la página de inicio para continuar.');
        window.location.href = '/'; // Redirigir al inicio si no hay nombre
        return;
    }

  var instructionsModal = document.getElementById('instructions-modal');
  var closeModal = document.querySelector('.close');
  var closeInstructions = document.getElementById('closeInstructions');

  // Show the instructions modal on page load
  instructionsModal.style.display = 'flex';

  // Close the modal when the user clicks on the close button
  closeModal.onclick = function() {
      instructionsModal.style.display = 'none';
  };

  // Close the modal when the user clicks on the close button
  closeInstructions.onclick = function() {
      instructionsModal.style.display = 'none';
  };

  // Close the modal when the user clicks outside of the modal
  window.onclick = function(event) {
      if (event.target == instructionsModal) {
          instructionsModal.style.display = 'none';
      }
  };
});