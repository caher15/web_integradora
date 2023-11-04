<?php
if($_POST)
{
	$nombre=$_POST['producto'];
	$precio=$_POST['precio'];
	$cantidad=$_POST['cantidad'];
	$subtotal=$precio * $cantidad;
	$fechaHora=Date("F_j_Y");
	$pedido=array();
	$ruta=$fechaHora."_pedido.json";

	if (file_exists($ruta)) 
	{
		$archivo=file_get_contents($ruta);
		$pedido=json_decode($archivo,true);

		$pedido[]=array('nombre'=>$nombre,'precio'=>$precio,'cantidad'=>$cantidad,'subtotal'=>$subtotal);
		$json_string=json_encode($pedido);
		echo $json_string;

		$file=$ruta;
		file_put_contents($file,$json_string);
		echo '<META HTTP-EQUIV="REFRESH" CONTENT="3;URL=index.php">';                            
	}
	else{
		$pedido[]=array('nombre'=>$nombre,'precio'=>$precio,'cantidad'=>$cantidad,'subtotal'=>$subtotal);
		$json_string=json_encode($pedido);
		echo $json_string;

		$file=$ruta;
		file_put_contents($file,$json_string);

		echo '<META HTTP-EQUIV="REFRESH" CONTENT="3;URL=index.php">';   
		
	}
}
?>