<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Leer JSON con PHP</title>
	<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Inter:wght@300;500&display=swap" rel="stylesheet">
	<!-- <link rel="stylesheet" type="text/css" href="css/estilos.css"> -->
</head>
<style >
	*{
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}
html{
    font-size: 52.5%;
    font-family: 'DM Sans', sans-serif;
}
header{
	
	margin-top: 75px;
	margin-bottom: 25px;
}
table{
	margin-left: 20px;
	width: 90%;
    border-collapse: collapse;
    margin-bottom: 20px;
}
/* Estilo para las celdas del encabezado */
th {
    background-color: #f2f2f2;
    text-align: left;
    padding: 10px;
    border: 1px solid #ccc;
	font-size: 2.4rem;
    font-weight: bold;
}

/* Estilo para las celdas de datos */
td {
    text-align: center;
    padding: 10px;
    border: 1px solid #ccc;
	font-size: 2.2rem;
    
}

h1{
	font-size: 3.4rem;
	font-weight: bold;
}
th{
	font-size: 2.4rem;
	font-weight: 400;
}
h3{
	font-size: 2.4rem;
	font-weight: 500;
	
}
#Total{
	font-size: 3.4rem;
	font-weight: bold;
}
#Cuadricula{
	width: 90%;
}
.boton{
	margin-top: 25px;
    padding: 5px;
    width: auto;
    height: auto;
    background-color: var(--off-white);
    /* Sombra */
    box-shadow: 0px 4px 8px rgba(89, 73, 30, 0.16);
    border: none;
    border-radius: 5px;
    font-size: 1.4rem;
    font-weight: bold;
    text-decoration: none;
    color: var(--black);
}
.nombre{
	margin-bottom: 15px;
	display: flex;
	justify-content: center;
	align-items:center;
}
.regresar{
	margin-bottom: 15px;
	display: flex;
	justify-content: center;
	align-items:center;
}

</style>
<body>

	<header>
		<h1><center>Pedido registrado en JSON - PHP</center></h1>
	</header>

	<section id="Cuadriculada">
		<table class="grilla" id="tablajson">
			<thead>
				<th>Nombre</th>
				<th>Precio</th>
				<th>Cantidad</th>
				<th>Subtotal</th>

			</thead>

<?php 
$NombreArchivo=Date("F_j_Y")."_Pedido.json";
$Total=0;
if(file_exists($NombreArchivo)){
	$archivo=file_get_contents($NombreArchivo);
	$productos=json_decode($archivo);
	foreach ($productos as $producto) {
		echo '<tr><td><h3>'.$producto->{'nombre'}.'</h3></td>';
		echo '<td><h3>$'.$producto->{'precio'}.'</h3></td>';
		echo '<td><h3>'.$producto->{'cantidad'}.'</h3></td>';
		echo '<td><h3>$'.$producto->{'subtotal'}.'</h3></td></td>';
		
		echo '<td><a class="boton" href="mod.php?JSON='.$producto->{'nombre'}.'"><i class="fa-solid fa-gear"></i> Modificar</a></td>';
		echo '<td><a class="boton" href="eliminar.php?producto=' . urlencode($producto->{'nombre'}) . '"><i class="fa-solid fa-delete-left"></i> Eliminar</a></td>';
        $Total=$Total+$producto->{'subtotal'};
	}

}else{
	echo '<META HTTP-EQUIV="REFRESH" CONTENT="3;URL=index.php">';
}

?>	
		</table>
		
	</section>
	<section class="footer" id="Total">
		<?php
		echo "<br>";
		echo 'Total a pagar: $'.$Total;

		?>
		
	</section>
	
	<div class="regresar" >
		<a class="boton" href="index.php">Regresar</a>
	</div>
	<div class="nombre">
		<h2 class="nombre-content">POR: Christopher Axel Hernández Sánchez</h2>
		
	</div>
	

	
	

</body>
</html>