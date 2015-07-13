
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Borrando cuenta</h4>
      </div>
      <div class="modal-body">
        ¿Estas seguro que quieres borrar tu cuenta?
      </div>
      <div class="modal-footer">
      	<form action="content/boton_borrar.php" method="POST">
	        <input type="button" class="btn btn-default" data-dismiss="modal" value="No">
	        <input name="btnBorrar" type="submit" class="btn btn-danger" value="Si">
        </form>
      </div>
    </div>
  </div>
</div>

<?php
	if (isset($_POST['btnBorrar'])) {
		session_start();
      	include("../connect/conexion.php");

		// Me devuelve la cantidad de publicacion que aun no finalizaron o que terminaron, pero todavia no se eligio al ganador. 		
		$queryPublPendientes = "SELECT COUNT(*) FROM productos p INNER JOIN usuarios u ON(p.idUsuario = u.idUsuario) WHERE CURRENT_DATE() <= p.fecha_fin AND p.idGanador = 0 AND u.idUsuario = '".$_SESSION['id']."' ";
		$resPublPendientes = mysqli_query($link,$queryPublPendientes);
		$cantPublPendientes = mysqli_fetch_array($resPublPendientes);

		if ($cantPublPendientes[0] > 0) {	// El usuario no se puede eliminar. 
			header("Location: ../index.php?op=config&error=".base64_encode("Error al eliminar"));
		}else{	// El usuario se va a eliminar. 
			include("../parsers/head.php");

			//Actualizo el atributo del usuario a eliminado.
			$est = 1;
			$queryActUser = "UPDATE usuarios SET estado = '".$est."' WHERE idUsuario = '".$_SESSION['id']."' ";
			mysqli_query($link,$queryActUser);

			// Destruyo la session.
			session_start();
			unset($_SESSION['estado']);
			unset($_SESSION['id']);
			unset($_SESSION['user']);
			unset($_SESSION['start']);
			unset($_SESSION['expire']);
			unset($_SESSION['tieneFoto']);
			session_destroy();
		?>
  				<div class="col-xs-9 col-md-8 col-xs-offset-2" style="top: 30%;">
  					<div class="alert alert-success" role="alert">
	  					<h4>Tu cuenta se ah eliminado con extio!</h4>
	  					<p>Redirigiendo en 1 segundos... </p>
  					</div>
  				</div>
  				<script type="text/javascript">
  					function redireccionarPagina() {
  						window.location = "../index.php";
					}
					setTimeout("redireccionarPagina()", 1000);
  				</script>
		<?php
		}
	}
?>