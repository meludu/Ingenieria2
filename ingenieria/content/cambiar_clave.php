<?php
	include("../connect/conexion.php");
	session_start();

	$queryU = "SELECT password FROM usuarios WHERE idUsuario = '".$_SESSION['id']."' ";
	$resU = mysqli_query($link, $queryU);
	$tuplaU = mysqli_fetch_array($resU);

	if ($tuplaU['password'] == $_POST['viejopass']) {
		if ($_POST['nuevopass1'] == $_POST['nuevopass2']) {
			$queryActPass = "UPDATE usuarios SET password = '".$_POST['nuevopass1']."' WHERE idUsuario = '".$_SESSION['id']."' ";
			mysqli_query($link,$queryActPass);
			header("Location: ../index.php?op=config&error=".base64_encode("Exito al cambiar la password"));
		}
	}else{
		header("Location: ../index.php?op=config&error=".base64_encode("Error password no es verdadero"));
	}
?>