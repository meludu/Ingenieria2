<?php
if (isset($_POST['idCategoria'])){
	$id_categ = $_POST['idCategoria'];
	include("/../connect/conexion.php");
	$sql="SELECT nombre_cat, idCategoria FROM categorias WHERE idCategoria='$id_categ'";
	$query = mysqli_query($link, $sql) or die(mysql_error());
	$res_query = mysqli_fetch_array($query);
	?>
	<div id="one">Desea dar de baja la categor&iacute;a <b><?php echo utf8_encode($res_query["nombre_cat"])?></b> ?
	</div>
	<span id="two">
		<a href="procesarBajaCateg.php?idCategoria=<?php echo $id_categ;?>" class="btn btn-primary">Si</a>
	</span>
<?php
}
?>
