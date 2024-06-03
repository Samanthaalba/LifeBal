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
    <div style="display: flex; justify-content: center;">
      <button type="button" class="btn-72" id="loginBtn">Entrar</button>
    </div>
  </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
