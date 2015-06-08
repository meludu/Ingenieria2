<?php
	include("../connect/conexion.php");
	session_start();
	/*echo $_FILE["avatar"]["name"];   	 // Nombre del archivo.
	echo $_FILE['avatar']['type'];   	 // tipo del archivo.
	echo $_FILE['avatar']['tmp_name'];   // Nombre del archivo de la imagen temporal.
	echo $_FILE['avatar']['size'];   	 // tamaño.
	echo $_SERVER["PHP_SELF"];*/

	if ( !empty($_POST['nombre']) && !empty($_POST['apellido'])) {
		if ( !isset($_FILES["avatar"]) || $_FILES["avatar"]["error"] > 0){
			echo "ha ocurrido un error";
		}else{
			echo "no hay error. ";
			//ahora vamos a verificar si el tipo de archivo es un tipo de imagen permitido.
			//y que el tamano del archivo no exceda los 16MB
			$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
			$limite_kb = 16384;
			if (in_array($_FILES['avatar']['type'], $permitidos) && $_FILES['avatar']['size'] <= $limite_kb * 1024){

				//este es el archivo temporal
				$imagen_temporal  = $_FILES['avatar']['tmp_name'];
				//este es el tipo de archivo
				$tipo = $_FILES['avatar']['type'];
				//leer el archivo temporal en binario
		        $fp = fopen($imagen_temporal, 'r+b');
				$data = fread($fp, filesize($imagen_temporal));
				fclose($fp);

				//escapar los caracteres
		        $data = mysql_escape_string($data);

				$resultado = mysqli_query($link,"UPDATE usuarios SET imagen = '".$data."' , tipoImagen = '".$tipo."' , nombre = '".$_POST['nombre']."' , apellido = '".$_POST['apellido']."' WHERE idUsuario = '".$_SESSION['id']."' ") ;

				if ($resultado){  // Se guardo todo perfectamente!
					header("Location: ../?op=cuenta");	//Estaria bueno agregar un mensaje de exito!
				}else{ // Error al copiar el archivo
					echo "ocurrio un error al copiar el archivo.";
				}
			}else{   //
				echo "archivo no permitido, es tipo de archivo prohibido o excede el tamano de $limite_kb Kilobytes";
			}	
		}
	}else{
		echo "Enviaste campos vacios... ";
	}
?>