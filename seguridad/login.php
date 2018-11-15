<?php
  $titulo = 'Login';
  if($_SERVER['REQUEST_METHOD'] == 'POST'){

    include '../DbSetup.php';

    $correo = isset($_POST['correo']) ? $_POST['correo'] : '';
    $contrasenna = isset($_POST['contrasenna']) ? $_POST['contrasenna'] : '';
    $usuario = $usuario_model->find($correo, $contrasenna);

    if (isset($usuario)) {
      session_start();
      $_SESSION['usuario_id'] = $usuario['id'];
      return header("Location: /home");
    } else {
      echo "<h3>Usuario o contraseña invalido</h3>";
    }
  }

  include '../shared/header.php';
?>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
  body, html {
      height: 100%;
      margin: 0;
      font-family: Arial, Helvetica, sans-serif;
  }

    * {
      box-sizing: border-box;
    }

    .bg-image {
      background-image: url("../imagenes/mountain.jpg");
      /* Add the blur effect */
      filter: blur(8px);
      -webkit-filter: blur(8px);
      height: 100%; 
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
    }

    .bg-text {
      font-weight: bold;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 2;
      width: 15%;
      padding: 20px;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="bg-image"></div>
  <div class="bg-text">
   <br><h2><center>Login</center></h2><br>
    <form class="form-signin" method="POST">
      <input type="email" class="form-control" id="inputEmail" placeholder="Correo electronico" name="correo" value="<?= isset($_POST['correo']) ? $_POST['correo'] : ''; ?>">
      <br>
      <input type="password" class="form-control" placeholder="Contraseña" name="contrasenna">
      <br><br>
      <input class="btn btn-primary" type="submit" name="" value="Login!">
      <a href="/seguridad/registro.php">Registrarse</a>
    </form>
  </div>
</body>
<?php
include '../shared/footer.php';
?>
