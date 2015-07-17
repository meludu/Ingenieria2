<?php
	include("../parsers/head.php");
	include("conexion.php");
	session_start();
	if (!empty($_POST['viejopass']) && !empty($_POST['nuevopass1']) && !empty($_POST['nuevopass2'])) {
		if ($_POST['nuevopass1'] === $_POST['nuevopass2']) {

			// Compruebo que la contraseña pertenesca al usuario.
			$queryComp = "SELECT * FROM usuarios WHERE idUsuario = '".$_SESSION['id']."' ";
			$resComp = mysqli_query($link,$queryComp);
			$tuplaComp = mysqli_fetch_array($resComp);

			if ($tuplaComp['password'] === $_POST['viejopass']) {
				
				$queryNewPass = "UPDATE usuarios SET password = '".$_POST['nuevopass1']."' WHERE password = '".$_POST['viejopass']."' ";
				if ($resNewPass = mysqli_query($link,$queryNewPass)) {
					echo "Se actualizooo";
				}else{
					echo "error en la query.";
				}
			}else{ ?>
				<div class="modal fade">
  					<div class="modal-dialog">
    					<div class="modal-content">
      						<div class="modal-header">
        						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        						<h4 class="modal-title">Error</h4>
      						</div>
      						<div class="modal-body">
        						<p>La contraseña enviada no coincide. </p>
      						</div>
      						<div class="modal-footer">
        						<!--<button type="button" class="btn btn-default" data-dismiss="modal">Volver</button>-->
        						<button type="button" class="btn btn-primary">Volver</button>
      						</div>
    					</div><!-- /.modal-content -->
  					</div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
				<script type="text/javascript">
					window.location='../index.php?op=config';
				</script>
			<?php
			}
		}else{
			echo "Los pass nuevos son distintos. ";
		}
	}else{
		echo "No coincide. ";
	}
?>