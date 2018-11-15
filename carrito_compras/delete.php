<?php
  $titulo = 'Borrar Articulo del Carrito';
  include '../DbSetup.php'; 
  include '../shared/header.php';
  include '../shared/nav.php';
  error_reporting(0);
  $id = isset($_GET['id']) ? $_GET['id'] : '';
  $articuloscarrito = $carrito_model->findArticulo($id);
  $user = $usuario_model->findUser($_SESSION['usuario_id']);
 
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $carrito_model->delete($id);
    return header("Location: /carrito_compras");
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
    <p>Id Articulo</p>
    <input class="form-control" name="descripcion" style="text-align:center;" required autofocus value="<?php echo $articuloscarrito['idArticulo']; ?>"readonly>
    <br><p>Esta seguro de eliminar el articulo del carrito?</p>
    <br><form method="POST">
      <input class="btn btn-primary" type="submit" value="Si">
      <a class="btn btn-danger" href="/carrito_compras/index.php">No</a>
    </form>
  </div>
</body>