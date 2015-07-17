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

		// Inserto la pregunta en la tabla correspondiente
		$queryAddComment = "INSERT INTO preguntas (pregunta, idUsuario, fecha, hora) VALUES ('".$_POST['texto']."', '".$_SESSION['id']."', '".$fechaAct[0]."', '".$horaAct[0]."')";
		mysqli_query($link,$queryAddComment);

		// Traigo el ultimo ID que inserte en preguntas. Debo ver bien esto que pasaria con muchos usuarios. 
		$lastID = mysqli_insert_id($link);

		// Inserto los enlaces de la pregunta con su respectivo producto en la tabla correspondiente. 
		$queryAddPregProd = "INSERT INTO preguntas_productos (idPregunta, idProducto) VALUES ('".$lastID."', '".$_POST['elProd']."')";
		mysqli_query($link,$queryAddPregProd);

		// Consulta notificacion
		$queryUser = "SELECT * FROM usuarios WHERE idUsuario = '".$_SESSION['id']."' ";		// Esta consulta es para traer el nombre del usuario
		$resUser = mysqli_query($link,$queryUser);
		$tuplaUser = mysqli_fetch_array($resUser);
		$msj = $tuplaUser['apellido'].", ".$tuplaUser['nombre']." ah preguntado en tu publicacion. ";

		$queryPro = "SELECT idUsuario AS creador FROM productos WHERE idProducto = '".$_POST['elProd']."' ";
		$resPro = mysqli_query($link,$queryPro);
		$tuplaPro = mysqli_fetch_array($resPro);

		$queryAddNoty = "INSERT INTO notificaciones (mensaje, estado, idEmisor, idReceptor, idProducto, fecha, hora) VALUES ('".$msj."', '1', '".$_SESSION['id']."', '".$tuplaPro['creador']."', '".$_POST['elProd']."', '".$fechaAct[0]."', '".$horaAct[0]."') ";
		mysqli_query($link,$queryAddNoty);

		header("Location: ../index.php?op=publicacion&idP=".$_POST['elProd']);
	}else{
		echo "<script type=\"text/javascript\">history.go(-1);</script>";  // Vuelvo hacia atras.
        exit;
	}
?>