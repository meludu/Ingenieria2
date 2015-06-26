<?php
	if (isset($_POST['idCategoria'])){
		$id_categ = $_POST['idCategoria'];
		//echo $id_categ;
		include("/../connect/conexion.php");

		$sql="SELECT nombre_cat, idCategoria FROM categorias WHERE idCategoria='$id_categ'";
		$query = mysqli_query($link, $sql) or die(mysql_error());
		$res_query = mysqli_fetch_array($query);
		?>
		<form id="formEditCategoria" name="modif_categ_frm" action="procesarEditarCateg.php?idCategoria=<?php echo $id_categ?>" method="post">
          <div class="form-group">
          	<label for="categoriaEdit">Modificar la categor&iacute;a <i><?php echo "<b>".utf8_encode($res_query["nombre_cat"])."</b>".":";?></i></label>
			<input type="text" class="form-control" id="categoriaEdit" name="editarCategoriaTxt" value="<?php echo utf8_encode($res_query["nombre_cat"]); ?>" placeholder="Ingrese nombre de categor&iacute;a" required>	
          </div>
          <div class="form-group">
            <input type="submit" class="btn btn-default" value="Modificar">
            <input type="reset" class="btn btn-danger" value="Limpiar">
          </div>
        </form>
	<?php
	}
	?>