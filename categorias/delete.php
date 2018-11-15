<?php
  $titulo = 'Categorias';
  include '../DbSetup.php';
  include '../shared/header.php';
  include '../shared/nav.php';
  $id = isset($_GET['id']) ? $_GET['id'] : '';
  $categoria = $categoria_model->findCategoria($id);
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $categoria_model->delete($id);
    return header("Location: /categorias");
  }
?>

<?php 
  $user = $usuario_model->findUser($_SESSION['usuario_id']);
  if ($user['rol'] == "Comprador"){ 
    return header("Location: /home/fail.php");
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
      padding: 10px;
      text-align: center;
    }
  </style>
  <title>Eliminar Categoría</title>
</head>
<body class="text-center">
  <div class="bg-text">
    <h2>Eliminar Categoria</h2><br>
    <input class="form-control" name="descripcion" style="text-align:center;" required autofocus value="<?php echo $categoria['descripcion']; ?>"readonly>
    <br><p>Está seguro de eliminar la categoría?</p>
    <form method="POST">
      <input class="btn btn-danger" type="submit" value="Si">
      <a class="btn btn-primary" href="/categorias">No</a>
    </form>
  </div>
</body>