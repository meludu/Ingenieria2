<?php

if(isset($_POST['idGanador'])){
	//print_r($_POST['idGanador']);
	$id_ganador = $_POST['idGanador'];
	include_once('../connect/conexion.php');
	$queryElegir = 'SELECT u.nombre AS nombre, u.apellido AS apellido, u.idUsuario AS idUsuario, o.idProducto idProducto FROM usuarios u 
					INNER JOIN ofertas o ON (o.idUsuario=u.idUsuario)
					INNER JOIN productos p ON (p.idProducto=o.idProducto)
					WHERE o.idUsuario='.$id_ganador;
	$ejec_query = mysqli_query($link, $queryElegir);

	if ($tupla = mysqli_fetch_array($ejec_query)){
		$id_producto = $tupla['idProducto'];
		$agregarIdGanador = "UPDATE productos SET idGanador='$id_ganador' WHERE idProducto='$id_producto'";
			//echo "$sql";
		if($res = mysqli_query($link, $agregarIdGanador)){
		?>	
		<button type="button" class="btn btn-primary" onclick="location.href='index.php?op=misProds'" data-dismiss="modal">Si</button>
		<?php
		}
		?>
		
	<?php
	}
}
?>