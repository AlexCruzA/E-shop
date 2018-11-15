<?php
  $titulo = 'Facturación ';
  include '../DbSetup.php'; 
  include '../shared/header.php';
  include '../shared/nav.php';
  error_reporting(0);
  $carrito= $carrito_model->getIdCarrito($user['id']);
  $search = isset($_GET['search']) ? $_GET['search'] : '';
  $user = $usuario_model->findUser($_SESSION['usuario_id']);
  //$carrito= $carrito_model->getIdCarrito($user['id']);
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $orden_model->insert($carrito['id']);
    $carrito_model->deleteAll($carrito['id']);
    return header("Location: /home");
  }
?>

<head>
  <?php  $result_array = $carrito_model->pay($carrito['id']);
    foreach ($result_array as $row) {
    }
  ?>
  <title>Eliminar Articulo</title>
</head>
<body class="text-center">
  <h2>Confirmar compra</h2>
  <table  class="table" align="center" border="3">
     <thead class="thead-dark">
      <tr>
        <th class="text-center">Nombre</th>
        <th class="text-center">Descripcion</th>
        <th class="text-center">Precio</th>
        <th class="text-center">Cantidad</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        $result_array = $carrito_model->index2($search,$carrito['id']);
        foreach ($result_array as $row) {
          $articulo= $articulo_model->getArticuloById($row['idArticulo']);
          echo "<tr>";
            echo "<td>" . $articulo['nombre'] . "</td>";
            echo "<td>" . $articulo['descripcion'] . "</td>";
            echo "<td>$" . $articulo['precio'] . "</td>";
            echo "<td>" . $row['cantidad'] . "</td>";
          echo "</tr>";
        } 
      ?>
    </tbody>
  </table>
  <?php 
    $result_array = $carrito_model->pay($carrito['id']);
    foreach ($result_array as $row) {
    }
  ?>
  <p>Desea realizar el pago por:</p>
 <br><center> <input type="text"  class="form-control" style="width: 7%;" name="imagen" required autofocus value="$<?php echo $row['precio']; ?>" readonly></center><br>
  <form method="POST">
    <input class="btn btn-primary" type="submit" value="Si">
    <a class="btn btn-danger" href="/carrito_compras/index.php">No</a>
  </form>
</body>
