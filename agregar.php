<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/estilos3.css">
<title>Agregar a carrito</title>
</head>
<body>
	<header>
	</header>
<section>
	<?php
		if(isset($_GET['id'])){
			$id=$_GET['id'];
			#Conexion a MySQL
		$conexion = mysqli_connect("localhost","root","")
		or die ("Fallo en el establecimiento de la conexion");
		#Seleccionamos la base de datos a utilizar 
		mysqli_select_db($conexion,"bd_prueba")
		or die("Error en la seleccion de la base de datos"); 
		#Consulta para leer productos
		$Resultado=mysqli_query($conexion,"SELECT * FROM 'productos' WHERE 'id_producto'='".$id."';");
		while($row = mysqli_fetch_array($Resultado))
		{
				echo '<img src="img/'.$row['imagen_p'].'" class="ImagenG">';
				echo '<form action="acumular.php" method="post" name="AgregarCarrito">';
				echo '<input type="text" name="producto" value="'.$row['precio_p'].'" readonly="readonly">';
				echo '$<input type="number" name="precio" size="3" value="'.$row['precio_p'].'" readonly="readonly">MXN';
				echo '<input type="number" name="cantidad" size="2" max="10" min="1">';
				echo '<input name="Agregar" type="submit" id=btnagregar value="Agregar">';
				echo '</form>';
			}

		}
		else{
			echo '<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=carrito.php">';
		}

	mysqli_close($conexion);
	?>
</section>
</body>
</html>		 