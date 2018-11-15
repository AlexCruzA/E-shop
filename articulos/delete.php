<?php
  $titulo = 'Articulos';
  include '../DbSetup.php';
  include '../shared/header.php';
  include '../shared/nav.php';
  $id = isset($_GET['id']) ? $_GET['id'] : '';
  $articulo = $articulo_model->findArticulo($id);

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $articulo_model->delete($id);
    return header("Location: /articulos");
  }
?>

 <?php 
  $user = $usuario_model->findUser($_SESSION['usuario_id']);
  if ($user['rol'] == "Comprador"){ 
      return header("Location: /home/fail.php");
  }?>

<head>
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
    <input class="form-control" name="descripcion" style="text-align:center;" required autofocus value="<?php echo $articulo['descripcion']; ?>"readonly>
  <br><p>Esta seguro de eliminar el articulo?</p>
    <form method="POST">
      <input class="btn btn-danger" type="submit" value="Si">
      <a class="btn btn-primary" href="/articulos">No</a>
    </form>
  </div>
</body>
