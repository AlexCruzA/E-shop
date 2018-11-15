<?php
  $titulo = 'Registro';
  if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
    include '../DbSetup.php';

    $nombre=isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $apellidos=isset($_POST['apellidos']) ? $_POST['apellidos'] : '';
    $correo = isset($_POST['correo']) ? $_POST['correo'] : '';
    $contrasenna = isset($_POST['contrasenna']) ? $_POST['contrasenna'] : '';
    $password_confirmation = isset($_POST['password_confirmation']) ? $_POST['password_confirmation'] : '';
    $direccion=isset($_POST['direccion']) ? $_POST['direccion'] : '';
    $rol=isset($_POST['rol']) ? $_POST['rol'] : '';

    if ($contrasenna != $password_confirmation) {
      echo "<h3>Las contraseñas no coinciden</h3>";
    } else if(($nombre=='')||($apellidos=='')||($correo=='')||($direccion=='')||($rol=='')){
      echo "Todos los datos son requeridos";
    }else {
     $usuario_model->insert( $nombre, $apellidos, $correo, $contrasenna,$direccion,$rol);
     $user= $usuario_model->getIdUsuario();
       $carrito_model->insert( $user['id']);
       echo "Este es el id:" .$user['id'];
      echo "<h3>Usuario registrado con éxito</h3>";
      return header("Location: /seguridad/login.php");
    }
  }
  include '../shared/header.php';
?>

<head>
  <style>
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
<body class="text-center ">
  <div class="bg-text">
    <form  method="POST">
      <br><h2>Registro</h2><br>
      <input placeholder="Nombre" class="form-control" type="text" name="nombre" >
      <br>
      <input placeholder="Apellidos" class="form-control" type="text" name="apellidos">
      <br>
      <input placeholder="Correo" class="form-control" type="email" name="correo">
      <br>
      <input placeholder="Contraseña" class="form-control" type="password" name="contrasenna">
      <br>
      <input placeholder="Confirmar contraseña" class="form-control" type="password" name="password_confirmation">
      <br>
      <input placeholder="Direccion" class="form-control" type="text" name="direccion">
      <br>
      <select class="form-control" style="width: 100%;" name="rol">
        <option  value="Comprador">Comprador</option>
      </select> 
      <br><br>
      <input class="btn btn-primary" type="submit" name="" value="Registrarme!">
      <a href="/seguridad/login.php">Login</a>
    </form>
  </div>
</body>
<?php include '../shared/footer.php';?> 