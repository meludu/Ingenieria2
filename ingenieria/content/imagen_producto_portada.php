<?php 
	include("../connect/conexion.php");

	$consultaImagePortada = "SELECT portada, tipoPortada FROM productos WHERE idProducto = '".$_GET['idPro']."' ";
	$resultadoImagePortada = mysqli_query($link,$consultaImagePortada);

	$registroImagePortada = mysqli_fetch_assoc($resultadoImagePortada);

	$imgPortada = $registroImagePortada['portada'];
	$tipoPortada = $registroImagePortada['tipoPortada'];

	header("Content-type: $tipoPortada");
	echo $imgPortada;
?>