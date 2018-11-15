<?php
  $titulo = 'Articulos';
  include '../shared/header.php';
  include '../shared/nav.php';
  include '../DbSetup.php';

  if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
    $descripcion=isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
    $id_categoria=isset($_POST['id_categoria']) ? $_POST['id_categoria'] : '';
    $nombre=isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $precio=isset($_POST['precio']) ? $_POST['precio'] : '';
    $nombre_imagen=$_FILES['imagen']['name'];
    $tipo_imagen=$_FILES['imagen']['type'];
    $tamagno_imagen=$_FILES['imagen']['size'];
    $carpeta_destino=$_SERVER['DOCUMENT_ROOT'].'\\imagenes\\';
    move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta_destino.$nombre_imagen);
    
    if(($descripcion=='')||($id_categoria=='')||($nombre_imagen=='')||($nombre=='')||($precio=='')){
      echo "Todos los datos son requeridos";
    }else {
     $articulo_model->insert( $descripcion, $id_categoria, $nombre_imagen,$nombre,$precio);
      echo "<h3>Articulo registrado con éxito</h3>";
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
    <h2>Agregar Articulos</h2><br>
    <form method="POST"  enctype="multipart/form-data">
      <input type="text" class="form-control" placeholder="Nombre" name="nombre">
      <br>
      <input type="text" class="form-control" placeholder="Descripción" name="descripcion" >
      <br>
      <input  type="number" class="form-control" placeholder="Precio" name="precio"  min="1">
      <br>
      <select class="form-control" style="width: 100%;" name="id_categoria">
        <?php
          $result_array1 = $categoria_model->index($search);
          foreach ($result_array1 as $row) {
            echo "<option  value='".$row['descripcion']."''>".$row['descripcion']."</option>";    
          } 
        ?>
      </select>     
      <br>
      <input class="form-control" type="file" name="imagen" size="20">
      <br>
      <input class="btn btn-primary" type="submit" name="" value="Guardar">
    </form>
  </div>
</body>

<?php
include '../shared/footer.php';
?>

