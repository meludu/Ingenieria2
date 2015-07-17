<?php 
	// para usar llamar al archivo de esta forma, <img src="PHP/imagen.php?id= echo $tuplaUser['idUsuario']; ">
	include("../connect/conexion.php");
	session_start();
	if (isset($_SESSION['estado']) && $_SESSION['estado'] == "online") {

		if ($_GET['id'] > 0) {

			$consulta = "SELECT imagen, tipoImagen FROM usuarios WHERE idUsuario = '".$_GET['id']."' ";
			$resultado = mysqli_query($link,$consulta);

			$registro = mysqli_fetch_assoc($resultado);

			$img = $registro['imagen'];
			$tipo = $registro['tipoImagen'];

			$_SESSION['tieneFoto'] = true;
			header("Content-type: $tipo");
			echo $img;
		}
	}
?>