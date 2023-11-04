<?php
$NombreArchivo = Date("F_j_Y") . "_Pedido.json";

if (file_exists($NombreArchivo)) {
    $archivo = file_get_contents($NombreArchivo);
    $productos = json_decode($archivo, true);

    if (!empty($productos)) {
        // Recupera el nombre del producto a eliminar desde el parámetro en la URL
        $producto_a_eliminar = isset($_GET['producto']) ? $_GET['producto'] : '';

        if (!empty($producto_a_eliminar)) {
            // Busca el índice del producto en el array
            $indice_producto = array_search($producto_a_eliminar, array_column($productos, 'nombre'));

            if ($indice_producto !== false) {
                // Elimina el producto del array utilizando el índice
                unset($productos[$indice_producto]);

                // Reorganiza los índices del array
                $productos = array_values($productos);

                $json_string = json_encode($productos);
                echo "<h2>Nueva Cadena de JSON</h2>";
                echo $json_string;

                file_put_contents($NombreArchivo, $json_string);

                // Redireccionar a leerJSON.php después de la eliminación
                header("Location: leerJSON.php");
                exit();
            } else {
                echo "El producto no se encontró en la lista.";
                header("Location: leerJSON.php");
            }
        } else {
            echo "No se proporcionó un nombre de producto para eliminar.";
        }
    } else {
        echo "La lista de productos está vacía.";
        header("Location: index.php");
    }
} else {
    echo "No existe el archivo";
}
?>
