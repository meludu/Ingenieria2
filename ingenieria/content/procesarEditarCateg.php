<?php
session_start();

if ($_SESSION["estado"] == "online") {

	if (isset($_GET["idCategoria"])){
		$id_categ_modif = $_GET["idCategoria"];
	}

	$categ_modif = utf8_decode($_POST["editarCategoriaTxt"]);

	if (empty($categ_modif)){
		$value = 'false';
	}
	else {

		include("/../connect/conexion.php");

		$validar = "SELECT nombre_cat FROM categorias WHERE nombre_cat='$categ_modif'";
		$ejec_validar = mysqli_query($link, $validar);

		if ($reg_valida = mysqli_fetch_array($ejec_validar)){
		    $value = 'false';
		}
		else{
			//Actualizar datos en la base de datos
			$sql = "UPDATE categorias SET nombre_cat='$categ_modif' WHERE idCategoria='$id_categ_modif'";
			//echo "$sql";
			$res = mysqli_query($link, $sql);
			$value = 'true';
		}
		?>
		<form name="sendErrorValue" method="post" action="administrar.php?siteMap=categorias">
		    <input type="hidden" name="errorEdit" value="<?php echo $value?>">
		</form>
		<script languaje="javascript" type='text/javascript'>
		    document.sendErrorValue.submit();
		</script> 
		<?php
		mysqli_close($link);
	}
}
?>