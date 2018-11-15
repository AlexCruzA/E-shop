<?php
  $titulo = 'Categorias';
  include '../shared/header.php';
  include '../shared/nav.php';
  include '../DbSetup.php';

  if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
    $descripcion=isset($_POST['descripcion']) ? $_POST['descripcion'] : '';

    if($descripcion==''){
      echo "Todos los datos son requeridos";
    }else {
     $categoria_model->insert( $descripcion);
      echo "<h3>Categoria registrada con éxito</h3>";
      return header("Location: /home/index.php");
    }
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
</head>
<body class="text-center">
  <div class="bg-text">
    <h2>Agregar Categoria</h2><br>
    <form method="POST">
      <input type="text" class="form-control" placeholder="Descripción" name="descripcion" >
      <br>
      <input type="submit" class="btn btn-primary" placeholder="Guardar" name="" value="Guardar">
    </form>
  </div>
</body>  
<?php
include '../shared/footer.php';
?>

