<?php 
	include("../connect/conexion.php");

	$consultaPortada = "SELECT portada, tipoPortada FROM productos WHERE idProducto = '".$_GET['idPro']."' ";
	$resultadoPortada = mysqli_query($link,$consultaPortada);

	$registroPortada = mysqli_fetch_assoc($resultadoPortada);

	$imgPor = $registroPortada['portada'];
	$tipoPor = $registroPortada['tipoPortada'];

	header("Content-type: $tipoPor");
	echo $imgPor;

?>