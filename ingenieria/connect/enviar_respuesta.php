<?php
	if (!empty($_POST['texto'])) {
		include("conexion.php");
		session_start();

		// Traigo la fecha actual de la BD.
		$queryFechaAct = "SELECT CURDATE()";
		$resFechaAct = mysqli_query($link,$queryFechaAct);
		$fechaAct = mysqli_fetch_array($resFechaAct); 

		// Traigo la hora actual de la BD.  
		$queryHoraAct = "SELECT CURTIME()";
		$resHoraAct = mysqli_query($link,$queryHoraAct);
		$horaAct = mysqli_fetch_array($resHoraAct);

		// Inserto la repsuesta a la pregunta en la BD.
		$queryAltaRes = "INSERT INTO respuestas (respuesta, idPregunta, fecha, hora) VALUES ('".$_POST['texto']."', '".$_POST['preg']."', '".$fechaAct[0]."', '".$horaAct[0]."')";
		if (mysqli_query($link,$queryAltaRes)) {

			// Consulta que envia la notificacion de respuesta a la pregunta.
			// Informacion del usuario que esta enviando la respuesta y del producto publicado
			$queryUser = "SELECT * FROM usuarios WHERE idUsuario = '".$_SESSION['id']."' ";	  // Traigo informacion del usuario logeado
			$resUser = mysqli_query($link,$queryUser);
			$tuplaUser = mysqli_fetch_array($resUser);

			$queryPro = "SELECT nombre AS titulo FROM productos WHERE idProducto = '".$_POST['elProd']."' ";
			$resPro = mysqli_query($link,$queryPro);
			$tuplaPro = mysqli_fetch_array($resPro);

			// Informacion del usuario receptor de la notificacion
			$queryReceptor = "SELECT u.idUsuario AS idUser FROM preguntas p INNER JOIN usuarios u ON(p.idUsuario = u.idUsuario) WHERE p.idPregunta = '".$_POST['preg']."' ";
			$resReceptor = mysqli_query($link,$queryReceptor);
			$tuplaReceptor = mysqli_fetch_array($resReceptor);

			$msj = $tuplaUser['apellido'].", ".$tuplaUser['nombre']." ah respondido tu pregunta en ".$tuplaPro['titulo'].". ";

			$queryNotiRes = "INSERT INTO notificaciones (mensaje, estado, idEmisor, idReceptor, idProducto, fecha, hora) VALUES ('".$msj."', '1', '".$_SESSION['id']."', '".$tuplaReceptor['idUser']."', '".$_POST['elProd']."', '".$fechaAct[0]."', '".$horaAct[0]."')";
			if (mysqli_query($link,$queryNotiRes)) {

			header("Location: ../index.php?op=publicacion&idP=".$_POST['elProd']);}else{
				echo "no papi error: ".mysqli_error($link);
			}
		}else{
			echo "<script type=\"text/javascript\">history.go(-1);</script>";  // Vuelvo hacia atras.
        	exit;
		}
	}else{
		echo "<script type=\"text/javascript\">history.go(-1);</script>";  // Vuelvo hacia atras.
        exit;
	}
?>