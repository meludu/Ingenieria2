<form action="content/eliminar_oferta.php" method="POST">
	<input type="submit" name="btn_borrar" class="btn btn-danger btn-lg btn-block" data-toggle="modal" value="Borrar oferta">
</form>

<?php
	if (isset($_POST['btn_borrar'])) {
		include("../connect/conexion.php");
		session_start();

		$queryBajaOfer = "DELETE FROM ofertas WHERE idOferta = '".$_SESSION['oferta']."' ";
		mysqli_query($link,$queryBajaOfer);
		header("Location: ../index.php?op=publicacion&idP=".$_SESSION['prod']);
	}
?>