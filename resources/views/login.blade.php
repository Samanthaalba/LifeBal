<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar sesión</title>
  <link rel="stylesheet" href="css/loguin.css">
</head>
<body>

<div class="login-form">
  <h1>LifeBal</h1>
  <div class="form-group">
    <input type="text" class="form-control" placeholder="NickName" id="UserName" required>
    <i class="fa fa-user"></i>
  </div>
  <a href="/inicio"><button type="button" class="log-btn" id="loginBtn">entrar</button></a>
</div>

   <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>