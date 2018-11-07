<?php
  
  $search = isset($_GET['search']) ? $_GET['search'] : '';

  $titulo = 'Editar Cuenta';
  include '../seguridad/verificar_session.php';
  include '../DbSetup.php';

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

  include '../shared/header.php';
  include '../shared/nav.php';
?>

<?php 
  $user = $usuario_model->findUser($_SESSION['usuario_id']);
  if ($user['rol'] == "Comprador"){ 
    return header("Location: /home/fail.php");
}?>

<body class="text-center">
  <form method="POST">
    <input type="text" placeholder="Nombre" name="nombre" required autofocus value="<?= $usuario['nombre']?>" >
    <br>
    <input type="text" placeholder="Apellidos" name="apellidos" required autofocus value="<?= $usuario['apellidos']?>">
    <br>
    <input type="email" placeholder="Correo" name="correo" required autofocus value="<?= $usuario['correo']?>">
    <br>
    <input type="password" placeholder="Contraseña" name="contrasenna" >
    <br>
    <input type="password" placeholder="Confirmar contraseña" name="password_confirmation">
    <br>
    <input type="text" placeholder="Direccion" name="direccion" required autofocus value="<?= $usuario['direccion']?>">
    <br>
    <select name="rol">
      <option  value="Administrador" >Administrador</option>
      <option  value="Comprador">Comprador</option>
    </select> 
    <br>
    <input type="submit" name="" value="Guardar">
  </form>
<br><br>
<h2>Lista De Usuarios</h2>
  <table align="center" border="3">
    <tr>
      <th class="text-center">ID</th>
      <th class="text-center">Nombre</th>
      <th class="text-center">Apellidos</th>
      <th class="text-center">Correo</th>
      <th class="text-center">Direccion</th>
      <th class="text-center">Rol</th>
      <th class="text-center">Opciones</th>
    </tr>

    <?php
      include '../DbSetup.php';
      $result_array = $usuario_model->index($search);
      foreach ($result_array as $row) {
        echo "<tr>";
          echo "<td>" . $row['id'] . "</td>";
          echo "<td>" . $row['nombre'] . "</td>";
          echo "<td>" . $row['apellidos'] . "</td>";
          echo "<td>" . $row['correo'] . "</td>";
          echo "<td>" . $row['direccion'] . "</td>";
          echo "<td>" . $row['rol'] . "</td>";
          echo "<td>" .
                "<a href='/articulos/edit.php?id=" . $row['id'] . "'>Editar</a>".
                " ".
                "<a href='/articulos/delete.php?id=" . $row['id'] . "'>Eliminar</a>".
                "</td>";
        echo "</tr>";
      } 
    ?>
  </table>


</body>

<?php include '../shared/footer.php'; ?>

