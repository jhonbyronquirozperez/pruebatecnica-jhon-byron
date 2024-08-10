<?php  

### Manejo de la sesión ###
session_start();
if(!isset($_SESSION['usuario'])){
    header("Location:../index.php");
}else{
    if($_SESSION['usuario']=="ok"){
        $nombreUsuario = $_SESSION["nombreUsuario"];
    }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>

<!-- variable de redireccion -->
 <?php $url = "http://".$_SERVER['HTTP_HOST']."/Prueba%20técnica%20analista%20desarrollador%20full%20stack%20JHON%20BYRON%20QUIROZ"?>

<nav class="navbar navbar-expand navbar-light bg-light">
    <div class="nav navbar-nav">
        <a class="nav-item nav-link active" href="#">Administrador del sitio web <span class="sr-only">(current)</span></a>
        <a class="nav-item nav-link" href="<?php echo $url;?>/administrador/inicio.php">Inicio</a>
        <a class="nav-item nav-link" href="<?php echo $url;?>/administrador/sesion/productos.php">Productos</a>
        <a class="nav-item nav-link" href="<?php echo $url;?>/administrador/sesion/inventario.php">Inventario</a>
        <a class="nav-item nav-link" href="<?php echo $url;?>/administrador/sesion/cerrar.php">cerrar sesión</a>
        <a class="nav-item nav-link" href="<?php echo $url;?>">Ver sitio</a>
    </div>
</nav>




  <!-- principal container -->
  <div class="container">
    <br><br>
    <div class="row">