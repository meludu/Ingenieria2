<?php
	include("conexion.php");
	if (empty($_POST['correo']) || empty($_POST['clave'])) {
		?>
		<script type='text/javascript'>
		  alert("Error en el logueo");
		  window.location='../index.php?op=login';
		</script>
	<?php
	}else{ // Ambos campos tienen informacion.
		$query = "SELECT * FROM usuarios WHERE email = '".$_POST['correo']."' AND password = '".$_POST['clave']."' ";
		$res = mysqli_query($link,$query);
		
		$c = mysqli_num_rows($res);

		if ($c == 1) {
			$dato = mysqli_fetch_assoc($res);
			if ($dato['estado'] == 0) {
				session_start();
				$_SESSION['estado'] = "online";
				$_SESSION['id'] = $dato['idUsuario'];
				$_SESSION['user'] = $_POST['correo'];
				$_SESSION['tipo'] = $dato['tipo'];
				$_SESSION['nombre_user'] = $dato['nombre'];
				$_SESSION['start'] = time();
				$_SESSION['expire'] = $_SESSION['start'] + (40 * 60);   // Expira en 40 minuto.  
				$_SESSION['tieneFoto'] = false;
				if (!empty($dato['tipoImagen'])) {
					$_SESSION['tieneFoto'] = true;
				}
				echo $_SESSION['tipo'];
				header("Location: ../index.php");
			}else{ // El usuarui elimino su cuenta ?>
				<script type="text/javascript">
					alert("La cuenta fue eliminada. ");
					window.location = '../index.php?op=registro';
				</script>
			<?php
			}
		}else{  // Contraseña incorrecta o email no valido. ?>
			<script type='text/javascript'>
			  alert("Error en el logueo");
			  window.location='../index.php?op=login';
			</script>
		<?php
		}
	}
	mysqli_close($link);
?>