<?php
	include("conexion.php");
	if (empty($_POST['correo']) || empty($_POST['clave'])) {
		echo "vacias";
	}else{ // Ambos campos tienen informacion.
		$query = "SELECT * FROM usuarios WHERE email = '".$_POST['correo']."' AND password = '".$_POST['clave']."' ";
		$res = mysqli_query($link,$query);
		$c = mysqli_num_rows($res);
		if ($c == 1) {
			session_start();
			$dato = mysqli_fetch_assoc($res);
			$_SESSION['estado'] = "online";
			$_SESSION['id'] = $dato['idUsuario'];
			$_SESSION['user'] = $_POST['correo'];
			$_SESSION['start'] = time();
			$_SESSION['expire'] = $_SESSION['start'] + (20 * 60);   // Expira en 20 minuto. 
			$_SESSION['tieneFoto'] = false;
			if (!empty($dato['tipoImagen'])) {
				$_SESSION['tieneFoto'] = true;
			}
			header("Location: ../index.php");
		}else{  // Datos incorrectos.
			echo "El e-mail o el password son incorrectos. ". $c." cantidad de tuplas" ;
		}
	}
?>