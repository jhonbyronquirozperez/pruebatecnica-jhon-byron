<?php include("../template/header.php"); ?>

<?php
// Conexión a la base de datos
include("../config/bd.php");

// Consulta para obtener los detalles de cada producto
$sentenciaSQL = $conexion->prepare("SELECT id, nombre, precio, cantidad_en_stock, (precio * cantidad_en_stock) AS valor_total_producto FROM producto");
$sentenciaSQL->execute();
$listaProductos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

// Array para almacenar la suma de los valores totales por ID
$productosAgrupados = [];

foreach ($listaProductos as $producto) {
    $id = $producto['id'];
    
    // Si el ID ya existe en el array, sumamos el valor total del producto
    if (isset($productosAgrupados[$id])) {
        $productosAgrupados[$id]['valor_total_producto'] += $producto['valor_total_producto'];
        $productosAgrupados[$id]['cantidad_en_stock'] += $producto['cantidad_en_stock'];
    } else {
        // Si el ID no existe, lo agregamos al array
        $productosAgrupados[$id] = [
            'id' => $id,
            'nombre' => $producto['nombre'],
            'precio' => $producto['precio'],
            'cantidad_en_stock' => $producto['cantidad_en_stock'],
            'valor_total_producto' => $producto['valor_total_producto']
        ];
    }
}

// Mostrar el valor total del inventario por producto
foreach ($productosAgrupados as $producto) {
    echo "Producto ID: " . $producto['id'] . "<br>";
    echo "Nombre: " . $producto['nombre'] . "<br>";
    echo "Precio: " . $producto['precio'] . "<br>";
    echo "Cantidad en Stock: " . $producto['cantidad_en_stock'] . "<br>";
    echo "Valor Total del Producto: " . number_format($producto['valor_total_producto'], 2) . "<br><br>";
}
?>





<?php include("../template/footer.php"); ?>