<?php
session_start();
if ($_SESSION["estado"] == "online") {
$id_categ = $_GET["idCategoria"];

include("/../../connect/conexion.php");

$sql="SELECT nombre_cat, idCategoria FROM categorias WHERE idCategoria='$id_categ'";
$query = mysqli_query($link, $sql) or die(mysql_error());
$res_query = mysqli_fetch_array($query);

?>
<div class="container-fluid">
    <div class="row">
        <div id="editarCategoria" class="col-sm-8 col-sm-offset-3">
            <div class="alert alert-info" role="alert">
                <strong>Editar Categor&iacute;a</strong>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8 col-sm-offset-3">
            <form name="modif_categ_frm" action="procesarEditarCateg.php?idCategoria=<?php echo $id_categ?>" method="post">
              <div class="form-group">
                <label for="categoriaEdit">Modificar la categor&iacute;a <i><?php echo "<b>".utf8_encode($res_query["nombre_cat"])."</b>".":";?></i></label>
                <input type="text" class="form-control" id="categoriaEdit" name="editarCategoriaTxt" value="<?php echo $res_query["nombre_cat"]; ?>" placeholder="Ingrese nombre de categor&iacute;a">
              </div>
              <div class="form-group">
                <input type="button" class="btn btn-default" value="Modificar" onclick="validarModificarCateg()">
              </div>
            </form>
        </div>
    </div>
</div>
<?php
mysqli_close($link);
}
?>