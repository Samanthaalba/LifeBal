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

    // Cargar jugadores almacenados
    loadPlayers();

    function loadPlayers() {
        let players = JSON.parse(localStorage.getItem('players')) || [];
        const playerList = document.querySelector('#playerList tbody');
        playerList.innerHTML = ''; // Limpiar la lista antes de cargar
        players.forEach(player => addPlayerToTable(player));
    }

    function addPlayerToTable(player) {
        const playerList = document.querySelector('#playerList tbody');
        const row = document.createElement('tr');
        const nameCell = document.createElement('td');
        const dateCell = document.createElement('td');

        nameCell.textContent = player.name;
        dateCell.textContent = new Date(player.timestamp).toLocaleString();

        row.appendChild(nameCell);
        row.appendChild(dateCell);
        playerList.appendChild(row);
    }

    // No limpiar jugadores más viejos
    function clearOldPlayers() {
        // No se realiza ninguna acción para borrar jugadores
        // Los jugadores se mantendrán permanentemente en el localStorage
    }

    // No llamar a clearOldPlayers();

    // Abrir el modal de jugadores con autenticación
    viewPlayersBtn.addEventListener('click', function() {
        const password = prompt('Por favor, ingrese la contraseña para ver los jugadores:');
        if (password === 'test1234') {
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
        downloadCSV();
    });

    function downloadCSV() {
        let players = JSON.parse(localStorage.getItem('players')) || [];
        if (players.length === 0) {
            alert('No hay jugadores registrados para descargar.');
            return;
        }

        const csvContent = "data:text/csv;charset=utf-8," + 
            "Nombre,Fecha de Ingreso\n" +
            players.map(p => `${p.name},${new Date(p.timestamp).toLocaleString()}`).join("\n");

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
  const correctPassword = 'test1234';
  const cards = document.querySelectorAll(".card");
  cards.forEach(card => {
      card.addEventListener("click", function() {
          const isChecked = card.getAttribute("for") === document.querySelector("input[name='slider']:checked").id;
          if (isChecked) {
              window.location.href = card.getAttribute("data-link");
          }
      });
  });

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