<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Inter:wght@300;500&display=swap" rel="stylesheet">
<title>Galeria de productos</title>
</head>
<style>
	:root {
    /* Colores */
    --bitcoin-orange: #F7931A;
    --soft-orange: #FFE9D4;
    --secondary-blue: #1A9AF7;
    --soft-blue: #E7F5FF;
    --warm-black: #201E1C; 
    --black: #282623;
    --grey: #BABABA;
    --off-white: #FAF8F7;
    --just-white: #FFFFFF; 
}
	/* Estilo para la tabla */
	*{
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}
html{
    font-size: 52.5%;
    font-family: 'DM Sans', sans-serif;
}
.grid-container {
    width: 100%
    
}

/* Estilos para el encabezado */
header {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 20px;
    font-size: 2.4rem;
}

/* Estilos para la tabla */
table {
    width: 100%;
    border-collapse: collapse;
    
    flex-direction: column;
    align-items: center;
    grid-template-columns: repeat(3, 1fr); /* 3 columnas iguales */
    gap: 20px; /* Espacio entre las celdas */
    padding: 20px;

}
table tbody{
    width: 100%;
}

table th {
    background-color: #333;
    color: #fff;
    font-weight: bold;
    padding: 10px;
}

table td {
    text-align: center;
    padding: 10px;
    border: 1px solid #ccc;
}
table tr{
    font-size: 1.8rem;
}
/* Estilos para las imágenes de muestra */
.ImagenesP {
    max-width: 100px;
    max-height: 100px;
}

/* Estilos para el enlace del carrito */
.carrito {
    text-decoration: none;
}

.ImagenC {
    width: 30px;
    height: 30px;
}

/* Estilos para el botón "Ver Pedido" */
.boton {
    display: block;
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 10px;
    text-decoration: none;
    margin-top: 10px;
}
footer {
    width: 100%;
    height: 200px;
    background-color: var(--warm-black);
}
footer .terminos{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 90%;
    height: 90%;
    padding-top: 25px;
    padding-left: 25px;
    
}
footer a{
    font-size: 2.5rem;
    color: var(--off-white);
    text-decoration: none;
}
footer p{
    
    font-size: 2.5rem;
    color: var(--off-white);
}
footer a:hover{
    color: var(--bitcoin-orange);
}
</style>
<body>
	<header>
		
	</header>

	
        <header>
        <!-- Estilos para el encabezado -->
        
        <h1>Bienvenido a GAME-CLogic</h1>
        <p>Creado por: Christopher Axel Hernández Sánchez</p>
        <?php
		include("conexion.php");
		$Resultado=mysqli_query($conexion,"SELECT * FROM `productos` WHERE `existencia`>5;");
	
        ?>
        </header>
    
    <section>
        <div class="grid-container">
            <table >
                
                <?php
                while($row = mysqli_fetch_array($Resultado))
                {
                    echo '<tr><th>Nombre</th><th>Precio</th><th>Imagen de Muestra</th></tr>';
                    echo '<tr><td>'.utf8_encode($row['nombre_p']).'</td>';
                    echo '<td>$'.$row['precio_p'].' MXN</td>';
                    echo '<td><img src="img/'.$row['imagen_p'].'" class="ImagenesP"></td>';
                    // echo '<td>'.utf8_encode($row['descripcion_p']).'</td>';
                    echo '<td><a class="carrito" href="detalles.php?id='.$row['id_producto'].'"><img src="img/cart3.png" class="ImagenC"></a> </td></tr>';
        
                }
                mysqli_close($conexion);
                ?>
                
            </table>
            
        </div>
    </section>
    <?php 
      $nombreArchivo=date("F_j_Y")."_Pedido.json";
      if(file_exists($nombreArchivo)){
      	echo '<a class="boton" href="leerJSON.php"><h2>Ver Pedido</h2></a>';
      }



	 ?>
     <footer>
        <div class="terminos" >
            <p>By: Christopher Axel Hernández Sánchez</p>
            <a href="terminos.html">Terminos y condiciones</a>
        </div>
        
     </footer>
</body>
</html>