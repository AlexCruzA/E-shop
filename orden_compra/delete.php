<?php
  $titulo = '';
  include '../DbSetup.php';
  include '../shared/header.php';
  include '../shared/nav.php';
  error_reporting(0);
  $id = isset($_GET['id']) ? $_GET['id'] : '';
  $orden = $orden_model->findOrden($id);
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $orden_model->deleteArticulosOrden($id);
    return header("Location: /orden_compra/index.php");
  }
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
      padding: 10px;
      text-align: center;
    }
  </style>
  <title>Eliminar Articulo</title>
</head>
<body class="text-center">
  <div class="bg-text">
    <h2>Eliminar Articulo</h2><br>
    <p>Esta seguro de eliminar el articulo de la orden? <strong><?php echo $orden['idOrdenCompra']; ?></strong></p>
    <form method="POST">
      <input class="btn btn-primary" type="submit" value="Si">
      <a class="btn btn-danger" href="/orden_compra/index.php">No</a>
    </form>
  </div>
</body>