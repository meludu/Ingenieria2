<?php

	// Necesito la fecha actual de la BD.
	$queryFecAct = "SELECT CURDATE()";
	$resFecAct = mysqli_query($link,$queryFecAct);
	$tuplaFecAct = mysqli_fetch_array($resFecAct); 	// Aca tengo la fecha actual de la BD.

	// Traigo todos los productos de la BD.
	$queryProductos = "SELECT * FROM productos WHERE estado = 0 ";	// pongo que el estado sea 0 asi mejora la performanse de la consulta y no busca en los que ya estan eliminados
	$resProductos = mysqli_query($link,$queryProductos);
	while ( $tuplaProductos = mysqli_fetch_array($resProductos) ) {		// Aca tengo uno y cada uno de los productos.

		if ($tuplaFecAct[0] > $tuplaProductos['fecha_fin']) {	// Si la fecha de hoy es mayor a la fecha de fin de subasta, entonces borro la publicacion.
			$estP = 1;
			$queryActProducto = "UPDATE productos SET estado = '".$estP."' WHERE idProducto = '".$tuplaProductos['idProducto']."' ";
			$resActProducto = mysqli_query($link,$queryActProducto);
			//mysqli_free_result($resActProducto);
		} // fin if

	} // fin while

	mysqli_free_result($resProductos);

?>