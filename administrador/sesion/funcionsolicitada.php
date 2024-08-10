<?php include("../template/header.php"); ?>

<?php
// Conexión a la base de datos
include("../config/bd.php");

function obtenerCombinaciones($productos, $valorMaximo) {
    $combinaciones = [];

    // Generar todas las combinaciones posibles de 2 o 3 productos
    $numProductos = count($productos);
    for ($i = 0; $i < $numProductos; $i++) {
        for ($j = $i + 1; $j < $numProductos; $j++) {
            // Combinación de 2 productos
            $suma2 = $productos[$i]['precio'] + $productos[$j]['precio'];
            if ($suma2 <= $valorMaximo) {
                $combinaciones[] = [
                    'productos' => [$productos[$i]['nombre'], $productos[$j]['nombre']],
                    'suma' => $suma2
                ];
            }

            // Combinación de 3 productos
            for ($k = $j + 1; $k < $numProductos; $k++) {
                $suma3 = $productos[$i]['precio'] + $productos[$j]['precio'] + $productos[$k]['precio'];
                if ($suma3 <= $valorMaximo) {
                    $combinaciones[] = [
                        'productos' => [$productos[$i]['nombre'], $productos[$j]['nombre'], $productos[$k]['nombre']],
                        'suma' => $suma3
                    ];
                }
            }
        }
    }

    // Ordenar combinaciones por suma de precios en orden descendente
    usort($combinaciones, function($a, $b) {
        return $b['suma'] - $a['suma'];
    });

    // Limitar el listado a máximo 5 combinaciones
    return array_slice($combinaciones, 0, 5);
}
?>

<!-- Formulario para que el usuario ingrese el valor máximo -->
<form method="post" action="">
    <label for="valorMaximo">Ingrese el valor máximo:</label>
    <input type="number" name="valorMaximo" id="valorMaximo" required>
    <button type="submit">Calcular Combinaciones</button>
</form>

<?php
// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el valor máximo ingresado por el usuario
    $valorMaximo = $_POST['valorMaximo'];

    // Obtener los productos de la base de datos
    $sentenciaSQL = $conexion->prepare("SELECT nombre, precio FROM producto");
    $sentenciaSQL->execute();
    $productos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

    // Obtener las combinaciones que cumplan con el valor máximo
    $resultado = obtenerCombinaciones($productos, $valorMaximo);

    // Mostrar el resultado
    if (!empty($resultado)) {
        echo "<h3>Combinaciones encontradas:</h3>";
        foreach ($resultado as $combinacion) {
            echo "Combinación: " . implode(", ", $combinacion['productos']) . " - Suma: " . $combinacion['suma'] . "<br>";
        }
    } else {
        echo "<h3>No se encontraron combinaciones que cumplan con el criterio.</h3>";
    }
}
?>

<?php include("../template/footer.php"); ?>

