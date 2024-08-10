<?php include("../template/header.php"); ?>

<?php

### validaciones con condicion ternaria ###
$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$decimalPrice=(isset($_POST['decimalPrice']))?$_POST['decimalPrice']:"";
$stockQuantity=(isset($_POST['stockQuantity']))?$_POST['stockQuantity']:"";
$txtDescription=(isset($_POST['txtDescription']))?$_POST['txtDescription']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";


### Conexión BD ###
include("../config/bd.php");


### Acciones Modificar - Agregar -Cancelar ###
switch($accion){
    case "Agregar":

        $sentenciaSQL= $conexion->prepare("INSERT INTO producto (id,nombre,descripcion,precio,cantidad_en_stock) VALUES (:id,:nombre,:descripcion,:precio,:cantidad_en_stock);");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->bindParam(':nombre',$txtNombre);
        $sentenciaSQL->bindParam(':descripcion',$txtDescription);
        $sentenciaSQL->bindParam(':precio',$decimalPrice);
        $sentenciaSQL->bindParam(':cantidad_en_stock',$stockQuantity);
        $sentenciaSQL->execute();

        header("Location:productos.php");
        break;
    case "Modificar":
        
        $campos = array_filter([
            'nombre' => $txtNombre,
            'descripcion' => $txtDescription,
            'precio' => $decimalPrice,
            'cantidad_en_stock' => $stockQuantity
        ]);
    
        if ($setClause = implode(", ", array_map(fn($campo) => "$campo = :$campo", array_keys($campos)))) {
            $sentenciaSQL = $conexion->prepare("UPDATE producto SET $setClause WHERE id = :id");
            $sentenciaSQL->execute(array_merge($campos, ['id' => $txtID]));
        }
        
        header("Location:productos.php");
        break;
    
    

case "Seleccionar":
    
    $sentenciaSQL = $conexion->prepare("SELECT * FROM producto WHERE id=:id");
    $sentenciaSQL->bindParam(':id', $txtID);
    $sentenciaSQL->execute();
    $Producto = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

    if ($Producto) {
        $txtNombre = $Producto['nombre'];
        $txtID = $Producto['id'];
        $txtDescription = $Producto['descripcion'];
        $decimalPrice = $Producto['precio'];
        $stockQuantity = $Producto['cantidad_en_stock']; 
    } else {
        echo "Producto no encontrado.";
    }
    
    break;

    case "Borrar":

        $sentenciaSQL= $conexion->prepare("DELETE FROM producto WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute(); 

        
        header("Location:productos.php");
        break;     
}

### Mostrar los datos ###
$sentenciaSQL= $conexion->prepare("SELECT * FROM producto");
$sentenciaSQL->execute();
$listaProductos = $sentenciaSQL -> fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Formulario para agregar productos -->

<div class="col-md-3">

    <div class="card">
        <div class="card-header">
            Datos de producto
        </div>

        <div class="card-body">
        
        <!-- todo el formulario -->
            <form method="POST" enctype="multipart/form-data">

            <div class = "form-group">
            <label for="txtID">ID</label>
            <input type="text" class="form-control" id="txtID" value="<?php echo $txtID; ?>" name="txtID"  placeholder="ID">
            </div>

            <div class = "form-group">
            <label for="txtNombre">Nombre</label>
            <input type="text" class="form-control" id="txtNombre" value="<?php echo $txtNombre; ?>" name="txtNombre"  placeholder="Nombre">
            </div>

            <div class = "form-group">
            <label for="decimalPrice">Precio</label>
            <input type="number" class="form-control" id="decimalPrice" value="<?php echo $decimalPrice; ?>" name="decimalPrice"  placeholder="Precio">
            </div>

            <div class = "form-group">
            <label for="stockQuantity">Cantidad en stock</label>
            <input type="number" class="form-control" id="stockQuantity" value="<?php echo $stockQuantity; ?>" name="stockQuantity"  placeholder="Cantidad en stock">
            </div>
           
            <div class = "form-group">
            <label for="txtDescription">Descripción</label>
            <textarea id="txtDescription" name="txtDescription" value="<?php echo $txtDescription; ?>" rows="4" cols="27%" placeholder="Escribe la Descripción aquí..."></textarea>

            </div>
            <!-- botonera -->
            <div class="btn-group" role="group" aria-label="">
                <button type="submit" name="accion" value="Agregar" class="btn btn-success">Agregar</button>
                <button type="submit" name="accion" value="Modificar"  class="btn btn-warning">Modificar</button>
               <!-- <button type="submit" name="accion" value="Cancelar"  class="btn btn-info">Cancelar</button> -->
            </div>

            </form>
     <!-- todo el formulario -->
        </div>
        
    </div>
</div>

<!-- /Formulario para agregar productos -->


<!-- tabla de visualizacion de productos  -->
<div class="col-md-9">
  
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Cantidad en stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        <?php foreach($listaProductos as $producto) {?>
            <tr>
                <td><?php echo $producto['id']; ?></td>
                <td><?php echo $producto['nombre']; ?></td>
                <td><?php echo $producto['descripcion']; ?></td>
                <td><?php echo $producto['precio']; ?></td>
                <td><?php echo $producto['cantidad_en_stock']; ?></td>

                <td>
                    <form  method="post">
                    <input type="hidden" name="txtID" value="<?php echo $producto['id']; ?>"> 
                       <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary "/>
                       <input type="submit" name="accion" value="Borrar" class="btn btn-danger "/>
                       
                    </form>
                </td>
            </tr>
        <?php } ?>    
        </tbody>
    </table>

</div>
<!-- /tabla de visualizacion de productos  -->

<?php include("../template/footer.php"); ?>