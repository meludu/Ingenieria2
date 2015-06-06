<?php
	include("conexion.php");
	if (!empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['sexo']) && !empty($_POST['fechaNacimiento']) && !empty($_POST['email_1']) && !empty($_POST['email_2']) && !empty($_POST['clave_1']) && !empty($_POST['clave_2'])) {
		echo "campos completos";
		if ($_POST['email_1'] === $_POST['email_2']) {
			echo "son iguales";
			if ($_POST['clave_1'] === $_POST['clave_2']) {
				echo "Claves iguales";
				$consultaUser = "SELECT email FROM usuarios WHERE email = '".$_POST['email_1']."' ";
				$resultadoUser = mysqli_query($link,$consultaUser);
				$cantidadUser = mysqli_num_rows($resultadoUser);
				if ($cantidadUser == 0) {
					echo "El usuario no existe en la BD, bienvenido al sistema. $cantidadUser";
				}else{
					echo "El usuario ya existe :( --- $cantidadUser";
				}
			}else{
				echo "Claves diferentes";
			}
		}else{
			echo "son distintos";
		}
	}else{
		echo "campos vacios "; 
		//header("Location: ../content/registro.php");
	}
?>