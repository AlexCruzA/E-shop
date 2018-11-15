<?php
$titulo = 'Carrito de compras';
include '../DbSetup.php';
include '../shared/header.php';
include '../shared/nav.php';
error_reporting(0);
$search = isset($_GET['search']) ? $_GET['search'] : '';
$user = $usuario_model->findUser($_SESSION['usuario_id']);
$carrito= $carrito_model->getIdCarrito($user['id']);
?>

<head>
  <meta charset="utf-8">
</head>
<body class="text-center">
<br>
<h2> Carrito Compras</h2>
<br>
  <table  class="table" align="center" border="3">
    <thead class="thead-dark">
      <tr>
        <th class="text-center">Imagen</th>
        <th class="text-center">Id Carrito</th>
        <th class="text-center">Id Articulo</th>
        <th class="text-center">Nombre</th>
        <th class="text-center">Descripcion</th>
        <th class="text-center">Precio</th>
        <th class="text-center">Cantidad</th>
        <th class="text-center">Delete</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        $result_array = $carrito_model->index2($search,$carrito['id']);
        foreach ($result_array as $row) {
          $articulo= $articulo_model->getArticuloById($row['idArticulo']);
          echo "<tr>";
            echo "<td>" ."<img style=\"width: 20%;\" src='/imagenes/" . $articulo['imagen'] . "'>" . "</td>";
            echo "<td>" . $row['idCarrito'] . "</td>";
            echo "<td>" . $row['idArticulo'] . "</td>";
            echo "<td>" . $articulo['nombre'] . "</td>";
            echo "<td>" . $articulo['descripcion'] . "</td>";
            echo "<td>$" . $articulo['precio'] . "</td>";
            echo "<td>" . $row['cantidad'] . "</td>";
            echo "<td>" ."<a href='/carrito_compras/delete.php? id=" . $row['id'] . "'>Eliminar</a>"."</td>";
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
  <br>
  <a type='btn btn-primary'  class="btn btn-primary" href='/carrito_compras/pay.php? id=" . $row['id'] . "'> Pagar $<?php echo $row['precio']?></a>
</body>