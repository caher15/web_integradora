<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Inter:wght@300;500&display=swap" rel="stylesheet">
    
    <title>Modificar Cantidad</title>
    <style>
        body {
            font-family: 'DM Sans', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            padding: 20px;
        }
        h1 {
            font-size: 24px;
            color: #333;
        }
        h2 {
            font-size: 18px;
            color: #666;
        }
        .form-container {
            margin-top: 20px;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .button-container {
            text-align: center;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
        }
        a {
            display: block;
            text-align: center;
            text-decoration: none;
            color: #007bff;
            margin-top: 10px;
        }
        a:hover {
            text-decoration: underline;
        }
        .back-to-home {
    background-color: #ccc;
    color: #333;
    border: none;
    padding: 10px 20px;
    border-radius: 3px;
    cursor: pointer;
    margin-top: 10px;
}
    </style>
</head>
<body>
<table class="container">
    <tr>
        <td>
            <?php
            $Criterio = "nombre";
            $valor = $_GET['JSON'];

            $NombreArchivo = Date("F_j_Y") . "_Pedido.json";

            if (file_exists($NombreArchivo)) {
                $archivo = file_get_contents($NombreArchivo);
                $productos = json_decode($archivo, true);

                $contador = 0;
                foreach ($productos as &$producto) {
                    if ($Criterio == "nombre" && $producto['nombre'] == $valor) {
                        echo "<h1>Nombre producto: " . $producto['nombre'] . "</h1><br>";
                        echo "<h2>Precio: " . $producto['precio'] . "</h2><br>";
                        echo "<h2>Cantidad: " . $producto['cantidad'] . "</h2><br>";

                        // Verificar si se ha enviado el formulario para actualizar
                        if (isset($_POST['nueva_cantidad'])) {
                            // Actualizar la cantidad del producto
                            $producto['cantidad'] = $_POST['nueva_cantidad'];
                            $producto['subtotal'] = $producto['precio'] * $producto['cantidad'];

                            // Actualizar el archivo JSON
                            $json_string = json_encode($productos);
                            file_put_contents($NombreArchivo, $json_string);

                            // Redirigir a la página anterior
                            header("Location: leerJSON.php");
                            exit();
                        }

                        // Mostrar el formulario para modificar cantidad
                        echo '<form method="post">';
                        echo 'Cambiar cantidad: <input type="text" name="nueva_cantidad" value="' . $producto['cantidad'] . '"><br>';
                        
                        // Contenedor para centrar botón y enlace
                        echo '<div class="button-container">';
                        echo '<br><br><input type="submit" value="Modificar">';
                        echo '<br><br><a href="javascript:history.go(-1)">Regresar</a>';
                        echo '</div>';
                        
                        echo '</form>';

                        exit();
                    }

                    $contador++;
                }

                echo $contador . "<br>";
            } else {
                echo "No existe el archivo";
            }
            ?>
        </td>
    </tr>
</table>
</body>
</html>

