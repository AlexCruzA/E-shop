<?php
  $titulo = 'Editar Categoria';
  include '../DbSetup.php';
  include '../shared/header.php';
  include '../shared/nav.php'; 
  $id = isset($_GET['id']) ? $_GET['id'] : '';
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
    $categoria_model->update($id, $descripcion);
    return header("Location: /categorias");
  }
  $categoria = $categoria_model->findCategoria($id);
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
  <title>Editar Categoria</title>
</head>
<body>
  <div class="bg-text">
    <h2>Editar Categoria</h2>
    <form method="POST">
      <label>Descripción:</label>
      <input class="form-control" type="text" name="descripcion" required autofocus value="<?= $categoria['descripcion']?>">
      <br>
      <input class="btn btn-primary" type="submit" value="Salvar">
      <a href="/categorias/index.php">Atras</a>
    </form>
  </div>
</body>