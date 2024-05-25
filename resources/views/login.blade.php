<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar sesión</title>
  <link rel="stylesheet" href="css/login.css">

  <style>
    .form-control {
        text-align: center; /* Centra el texto horizontalmente */
        line-height: 38px; /* Centra el texto verticalmente */
    }
</style>
</head>
<body>

<div class="login-form">
  <h1>LifeBal</h1>
  <div class="form-group">
    <input type="text" class="form-control" placeholder="Nombre del Jugador" id="UserName" required>
    <i class="fa fa-user"></i>
  </div>
  <div style="display: flex; justify-content: center;">
    <a href="/inicio" class="log-btn" id="loginBtn"><button type="button" class="btn-72">Entrar</button></a>
  </div>
</div>

   <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>