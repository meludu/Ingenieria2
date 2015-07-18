<?php

if(isset($_POST['idGanador'])){
	$id_ganador = $_POST['idGanador'];
	$id_producto = $_POST['idProducto'];
	$necesidad = $_POST['necesidadUser'];
	$monto = $_POST['ofertaMonto'];
	
	include_once('../connect/conexion.php');

	//Setea idGanador de producto
	$agregarIdGanador = "UPDATE productos SET idGanador='$id_ganador' WHERE idProducto='$id_producto'";
	if ($res = mysqli_query($link, $agregarIdGanador)){
		//fecha actual
		$consultaFecha = "SELECT CURDATE()"; 
        $resFecha = mysqli_query($link,$consultaFecha); 
        $fechaActual = mysqli_fetch_array($resFecha);
        //para saber los datos del vendedor
		$traerVendedor = 'SELECT idUsuario, nombre FROM productos WHERE idProducto='.$id_producto;
		$query_exec = mysqli_query($link, $traerVendedor);
		if ($resul = mysqli_fetch_array($query_exec)){
			$queryAgregarGanancia = "INSERT INTO ganancias (idVendedor, idGanador, nombre, necesidad, monto, fecha) 
			VALUES ('".$resul['idUsuario']."','".$id_ganador."','".$resul['nombre']."','".$necesidad."','".$monto."','".$fechaActual[0]."') ";
			$resultado = mysqli_query($link, $queryAgregarGanancia);
		}
	}
		
	
}
?>