<?php  

session_start();

# redireccion del formulario y envio session
if($_POST){
    if(($_POST['usuario']=="123")&&($_POST['contraseña']=="123")){

        $_SESSION['usuario']="ok";
        $_SESSION['nombreUsuario']="123";

        header('location:inicio.php');
    }else{
        $mensaje = "!!!ERROR: El usuario y contraseña es literal (123)";
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
  
  <!-- formulario login -->
    <div class="container ">
    <br><br>
        <div class="row ">
        
            <div class="col-md-4 mx-auto">
                
            <!-- Card contenedor -->
             <div class="card ">
                <div class="card-header">
                    Inicio de sesión
                </div>
                <div class="card-body">
               
                <!-- Alerta inicio de sesion fallido -->
                 <?php if(isset($mensaje)){ ?>
                <div class="alert alert-primary" role="alert">
                    <?php echo $mensaje; ?>
                </div>
                 <?php }  ?>   

                <!-- formulario -->
                <form method="POST">

                    <div class = "form-group">
                        <label >Usuario</label>
                        <input type="text" class="form-control" name="usuario" placeholder="Ingresa con el usuario => 123">
                        <small id="emailHelp" class="form-text text-muted">El usuario y la contraseña para ingresar es: "123"</small>
                    </div>

                    <div class="form-group">
                        <label >contraseña:</label>
                        <input type="password" class="form-control" name="contraseña"  placeholder="Ingresa la contraseña => 123">
                    </div>

                    <button type="submit" class="btn btn-primary">Ingresar como administrador</button>

                </form>
                <!-- /formulario -->
                
                





                </div>
             </div>   
            <!-- /Card contenedor -->

            </div>            
        </div>
    </div>
 <!-- /formulario login -->

  </body>
</html>