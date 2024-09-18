<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar sesión</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.csss" rel="stylesheet" 
  integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
      <button type="button" class="btn-72" id="loginBtn">Entrar</button><br>
      <button type="button" class="btn-72" id="viewPlayersBtn">Ver informe</button>
    </div><br>
  </div>
</div>
<!-- Modal para ver jugadores -->
<div id="playersModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Detalles de jugadores</h2>
    <button id="downloadCsvBtn" type="button" class="button">
      <span class="button__text">.CSV</span>
      <span class="button__icon"><svg class="svg" data-name="Layer 2" id="bdd05811-e15d-428c-bb53-8661459f9307" viewBox="0 0 35 35" xmlns="http://www.w3.org/2000/svg"><path d="M17.5,22.131a1.249,1.249,0,0,1-1.25-1.25V2.187a1.25,1.25,0,0,1,2.5,0V20.881A1.25,1.25,0,0,1,17.5,22.131Z"></path><path d="M17.5,22.693a3.189,3.189,0,0,1-2.262-.936L8.487,15.006a1.249,1.249,0,0,1,1.767-1.767l6.751,6.751a.7.7,0,0,0,.99,0l6.751-6.751a1.25,1.25,0,0,1,1.768,1.767l-6.752,6.751A3.191,3.191,0,0,1,17.5,22.693Z"></path><path d="M31.436,34.063H3.564A3.318,3.318,0,0,1,.25,30.749V22.011a1.25,1.25,0,0,1,2.5,0v8.738a.815.815,0,0,0,.814.814H31.436a.815.815,0,0,0,.814-.814V22.011a1.25,1.25,0,1,1,2.5,0v8.738A3.318,3.318,0,0,1,31.436,34.063Z"></path></svg></span>
    </button>

    <!--<table id="playerList">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Fecha y hora de Ingreso</th>
          <th>Puntuación Quiz</th>
          <th>Tiempo Quiz</th>
          <th>Puntuación Memorama</th>
          <th>Tiempo Memorama</th>
          <th>Puntuación Sopa de Letras</th>
          <th>Tiempo Sopa de Letras</th>
          <th>Puntuación Crucigrama</th>
          <th>Tiempo Crucigrama</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>-->
  </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
