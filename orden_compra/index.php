<?php
  $titulo = '';
  include '../DbSetup.php';
  include '../shared/header.php';
  include '../shared/nav.php';
  error_reporting(0);
  $search = isset($_GET['search']) ? $_GET['search'] : '';
  $user = $usuario_model->findUser($_SESSION['usuario_id']);
  $carrito= $orden_model->getIdCarrito($user['id']);
?>

<head>
  <meta charset="utf-8">
</head>
<body class="text-center">
  <h2>Ordenes de compra</h2>

<form method="GET">
<input type="text" autofocus name="search" value="<?php echo  $search  ?>">
<input type='submit' class='btn btn-lg btn-outline-primary' value="Buscar">
<input type='submit' class='btn btn-lg btn-outline-primary' value="Limpiar filtro">
</form>
<br>
  <table class="table" align="center" border="3">
    <thead class="thead-dark">
      <tr>
        <th class="text-center">Imagen</th>
        <th class="text-center">Articulo</th>
        <th class="text-center">Cantidad</th>
        <th class="text-center">Precio</th>
        <th class="text-center">#OrdenCompra</th>
        <th class="text-center">Delete</th>
      </tr>
    </thead>
    <tbody>
      <?php
        include '../DbSetup.php';
        $result_array = $orden_model->index3($search,$carrito['id']);
        foreach ($result_array as $row) {
          $articulo= $articulo_model->getArticuloById($row['idArticulo']);
          echo "<tr>";
            echo "<td>" ."<img style=\"width: 20%;\" src='/imagenes/" . $articulo['imagen'] . "'>" . "</td>";
            echo "<td>" . $articulo['nombre'] . "</td>";
            echo "<td>" . $row['cantidad'] . "</td>";
            echo "<td>$" . $articulo['precio'] . "</td>";
            echo "<td>" . $row['idOrdenCompra'] . "</td>";
            echo "<td>" . "<a href='/orden_compra/delete.php?id=" . $row['id'] . "'>Eliminar</a>".  "</td>";
          echo "</tr>";
        } 
      ?>
    </tbody>  
  </table>
</body>