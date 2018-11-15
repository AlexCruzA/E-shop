<?php
  $search = isset($_GET['search']) ? $_GET['search'] : '';
  $titulo = 'Editar Cuenta';
  include '../DbSetup.php';
  include '../shared/header.php';
  include '../shared/nav.php';

  if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
    $nombre=isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $apellidos=isset($_POST['apellidos']) ? $_POST['apellidos'] : '';
    $correo = isset($_POST['correo']) ? $_POST['correo'] : '';
    $contrasenna = isset($_POST['contrasenna']) ? $_POST['contrasenna'] : '';
    $password_confirmation = isset($_POST['password_confirmation']) ? $_POST['password_confirmation'] : '';
    $direccion=isset($_POST['direccion']) ? $_POST['direccion'] : '';
    $rol=isset($_POST['rol']) ? $_POST['rol'] : '';
    $id = $usuario_model->findUser($_SESSION['usuario_id']);

    if ($contrasenna != $password_confirmation) {
      echo "<h3>Las contraseñas no coinciden</h3>";
    } else if(($nombre=='')||($apellidos=='')||($correo=='')||($direccion=='')||($rol=='')){
      echo "Todos los datos son requeridos";
    }else {
     $usuario_model->update( $id['id'],$nombre, $apellidos, $correo, $contrasenna,$direccion,$rol);
      echo "<h3>Usuario registrado con éxito</h3>";
      return header("Location: /home/index.php");
    }
  }

  $usuario = $usuario_model->findUser($_SESSION['usuario_id']);
?>
<?php 
    $user = $usuario_model->findUser($_SESSION['usuario_id']);
    if ($user['rol'] == "Comprador"){ 
      return header("Location: /usuarios/index_comprador.php");
  }?>

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
<body class="text-center">
  <div class="bg-text">
    <form method="POST">
      <h2>Perfil</h2><br>
      <input type="text" placeholder="Nombre" class="form-control" name="nombre" required autofocus value="<?= $usuario['nombre']?>" >
      <br>
      <input type="text" placeholder="Apellidos" class="form-control" name="apellidos" required autofocus value="<?= $usuario['apellidos']?>">
      <br>
      <input type="email" placeholder="Correo" class="form-control" name="correo" required autofocus value="<?= $usuario['correo']?>">
      <br>
      <input type="password" placeholder="Contraseña" class="form-control" name="contrasenna" >
      <br>
      <input type="password" placeholder="Confirmar contraseña" class="form-control" name="password_confirmation">
      <br>
      <input type="text" placeholder="Direccion" class="form-control" name="direccion" required autofocus value="<?= $usuario['direccion']?>">
      <br>
      <select class="form-control" style="width: 100%;" name="rol">
        <option  value="Administrador" >Administrador</option>
        <option  value="Comprador">Comprador</option>
      </select> 
      <br>
      <input class="btn btn-primary" type="submit" name="" value="Guardar">
    </form>
  </div>
</body>

<?php include '../shared/footer.php'; ?>

