/////////////////////////////////////////////////////////////////////////
// Logica del loguin para que el usuario no pueda entrar al inicio sin antes poner un nombre
/////////////////////////////////////////////////////////////////////////
document.addEventListener("DOMContentLoaded", function() {
  const userNameInput = document.getElementById("UserName");
  const loginBtn = document.getElementById("loginBtn");

  loginBtn.addEventListener("click", function(event) {
    if (!userNameInput.value.trim()) {
      event.preventDefault();
      alert("Por favor, complete el campo de Nombre del Jugador");
    } else {
      localStorage.setItem('playerName', userNameInput.value.trim());
      window.location.href = '/inicio';
    }
  });
});
