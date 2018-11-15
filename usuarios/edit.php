<?php
  $search = isset($_GET['search']) ? $_GET['search'] : '';
  $titulo = 'Editar Cuenta';
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

<br><h2><center>Lista De Usuarios</center></h2><br>
  <table class="table" align="center" border="3">
    <thead class="thead-dark">
      <tr>
        <th class="text-center">ID</th>
        <th class="text-center">Nombre</th>
        <th class="text-center">Apellidos</th>
        <th class="text-center">Correo</th>
        <th class="text-center">Direccion</th>
        <th class="text-center">Rol</th>
      </tr>
    </thead>

    <tbody>
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
        echo "</tr>";
      } 
    ?>
    </tbody>
  </table>


</body>

<?php include '../shared/footer.php'; ?>

