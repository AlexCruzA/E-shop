<?php
  
  $search = isset($_GET['search']) ? $_GET['search'] : '';

  //$titulo = 'Editar Cuenta';
  include '../seguridad/verificar_session.php';
  include '../DbSetup.php';
  include '../shared/header.php';
  include '../shared/nav.php';
  $usuario = $usuario_model->findUser($_SESSION['usuario_id']);
?>

<?php 
  $user = $usuario_model->findUser($_SESSION['usuario_id']);
  if ($user['rol'] == "Comprador"){ 
    return header("Location: /home/fail.php");
}?>

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

