<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar sesión</title>
  <link rel="stylesheet" href="css/login.css">
  <style>
    .form-control {
        text-align: center;
        line-height: 38px;
    }
  </style>
</head>
<body>
<div class="background">
  <img class="doc" src="/img/doc2.jpg" alt="">
  <div class="overlay"></div>
</div>
<div class="login-container">
  <div class="login-form">
    <h1>LifeBal</h1>
    <div class="form-group">
      <input type="text" class="form-control" placeholder="Nombre del Jugador" id="UserName" required>
      <i class="fa fa-user"></i>
    </div>
    <div class="botones">
      <button type="button" class="btn-72" id="loginBtn">Entrar</button>
      <button type="button" class="btn-72" id="viewPlayersBtn">Visitas</button>
    </div><br>
  </div>
</div>
<!-- Modal para ver jugadores -->
<div id="playersModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Lista de Visitas</h2>
    <button id="downloadCsvBtn">Descargar CSV</button>
    <table id="playerList">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Fecha y hora de Ingreso</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
</body
