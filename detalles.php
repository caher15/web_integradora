
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="estilosGal.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Agregar a carrito</title>

    <style>
       body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .product-card {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: 10px;
            padding: 20px;
            max-width: 300px;
            text-align: center;
        }

        .product-image {
            max-width: 100%;
        }

        .product-name {
            font-size: 20px;
            color: #333;
            margin-top: 10px;
        }

        .product-price {
            font-size: 16px;
            color: #666;
            margin-top: 5px;
        }

        .product-description {
            font-size: 14px;
            color: #888;
            margin-top: 10px;
        }

        .product-form {
            margin-top: 20px;
        }

        .product-form input[type="text"],
        .product-form input[type="number"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

         .product-form button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .product-form button:hover {
            background-color: #0056b3;
        }

        .product-form a {
            display: block;
            text-decoration: none;
            color: #007bff;
            margin-top: 10px;
            font-size: 16px;
            transition: color 0.3s;
        }

        .product-form a:hover {
            color: #0056b3;
        }
    </style>

</head>
<body>

<section>
    <?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        include("conexion.php");
        $Resultado=mysqli_query($conexion,"SELECT * FROM `productos` WHERE `id_producto`='".$id."';");
        while($row = mysqli_fetch_array($Resultado)){
            echo '<div class="container">';
            echo '<img src="img/'.$row['imagen_p'].'" class="product-image">';
            echo '<h2 class="product-name">'.utf8_encode($row['nombre_p']).'</h2>';
            echo '<p class="product-price">$'.$row['precio_p'].' MXN</p>';
            echo '<form class="product-form" action="detalles.php?id='.$id.'" method="post">';
            echo '<input type="text" name="producto" value="'.utf8_encode($row['nombre_p']).'" readonly="readonly">';
            echo '<input type="text" name="precio" size="1" value="'.$row['precio_p'].'" readonly="readonly"> MXN';
            echo '<br><br>';
            echo '<label for="cantidad">Cantidad: </label><input type="number" id="cantidad" placeholder="Cantidad" name="cantidad" size="8" max="10" min="1" value="1">';
            echo '<br><br>';
            echo '<button class="A" type="submit" name="agregar">Agregar al carrito</button>';
            echo '<a href="index.php">Regresar</a>';
            echo '</form>';
            echo '<p class="product-description">'.utf8_encode($row['descripcion_p']).'</p>';
            echo '</div>';
        }
        mysqli_close($conexion);
    } else {
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=carrito.php">';
    }

    if (isset($_POST['agregar'])) {
        // Recupera el nombre, precio y cantidad del producto
        $producto = $_POST['producto'];
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];

        // Carga el archivo JSON actual si existe
        $NombreArchivo = Date("F_j_Y") . "_Pedido.json";
        $productos = [];

        if (file_exists($NombreArchivo)) {
            $archivo = file_get_contents($NombreArchivo);
            $productos = json_decode($archivo, true);
        }

        // Agrega el nuevo producto al array
        $nuevoProducto = [
            'nombre' => $producto,
            'precio' => $precio,
            'cantidad' => $cantidad,
            'subtotal' => $precio * $cantidad,
        ];

        $productos[] = $nuevoProducto;

        // Convierte el array de productos a JSON y guarda en el archivo
        $json_string = json_encode($productos, JSON_PRETTY_PRINT);
        file_put_contents($NombreArchivo, $json_string);

        
        header("Location: carrito.php");
        exit();
    }
    ?>

</section>
</body>
</html>