<?php
session_start();
if ($_SESSION["estado"] == "online") {
$id_subcateg = $_GET["idSubCategoria"];

include("/../../connect/conexion.php");

$sql="SELECT * FROM subcategorias WHERE idSubCategoria='$id_subcateg'";
$query = mysqli_query($link, $sql);
$res_query = mysqli_fetch_array($query);
?>
<div class="container-fluid">
    <div class="row">
        <div id="editSubCategoria" class="col-sm-8 col-sm-offset-3">
            <div class="alert alert-info" role="alert">
                <strong> SubCategor&iacute;a</strong>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8 col-sm-offset-3">
            <form name="edit_subcateg_frm" action="procesarEditarSubCateg.php?idSubCategoria=<?php echo $id_subcateg; ?>" method="post">
              <div class="form-group">
                <?php
                $sql_categ = "SELECT nombre_cat FROM categorias WHERE idCategoria=".$res_query["idCategoria"];
                $res_categ = mysqli_query($link, $sql_categ);
                ?>
                <label for="modelo-modif">Modificar categor&iacute;a de la subcategoria <i><?php echo "<b>".utf8_encode($res_query["nombre"])."</b>".":"; ?></i></label><br />
                <select class="cambio" name="editCategoriaSelect">
                <?php
                if ($reg_resul = mysqli_fetch_array($res_categ)){
                ?>
                <option value="<?php echo $res_query['idCategoria']; ?>">
                <?php echo utf8_encode($reg_resul["nombre_cat"]); ?>
                </option>
                <?php
                    $idcategoria_query=$res_query["idCategoria"];
                    $ordenar = "SELECT * FROM categorias WHERE idCategoria<>'$idcategoria_query' ORDER BY nombre_cat"; //Como me viene la marca aca controlo que la marca no este repetida
                    $ejec_ordenar = mysqli_query($link, $ordenar);
                    while ($registro = mysqli_fetch_array($ejec_ordenar)){
                        $categoria = utf8_encode($registro["nombre_cat"]);
                        $idcategoria = $registro["idCategoria"];
                        echo "<option value='$idcategoria'>$categoria</option>";
                    }
                }
                ?>
                </select> 
              </div>
              <div class="form-group">
                <label for="editSubCategoriaTxt">Modificar la subcategor&iacute;a <i><?php echo "<b>".utf8_encode($res_query["nombre"])."</b>".":";?></i></label>
                <input type="text" class="form-control" id="subcategoriaEdit" name="editSubCategoriaTxt" placeholder="Ingrese nombre de subcategor&iacute;a">
              </div>                  
              <div class="form-group">
                <input type="button" class="btn btn-default" value="Modificar" onclick="validarModificarSubCateg()">
              </div>
            </form>
        </div>
    </div>
</div>
<?php
mysqli_close($link);
}
?>
