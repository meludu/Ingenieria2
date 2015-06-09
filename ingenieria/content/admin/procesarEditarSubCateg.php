<?php
session_start();

if ($_SESSION["estado"] == "online") {

if (isset($_GET["idSubCategoria"])){
    $idSubCategoriaModif = $_GET["idSubCategoria"];
}
$idCategoriaModif = $_POST["editCategoriaSelect"];
$subCategToModif = utf8_decode($_POST["editSubCategoriaTxt"]); //aca me traigo la subcategoria a updatear

include("/../../connect/conexion.php");

$validar = "SELECT nombre, idSubCategoria FROM subcategorias WHERE nombre='$subCategToModif'";
$ejec_validar = mysqli_query($link, $validar);

if ($reg_valida = mysqli_fetch_array($ejec_validar)){
    ?>
    <script languaje="javascript" type='text/javascript'>
        alert("ERROR, el modelo que usted le quiere poner ya existe o esta siendo usado!!");
        window.location='administrar.php?siteMap=subcategorias';
    </script>
<?php
}
else{
    //Actualizar datos en la base de datos
    $sql = "UPDATE subcategorias SET nombre='$subCategToModif',idCategoria='$idCategoriaModif' WHERE idSubCategoria='$idSubCategoriaModif'";
    $res = mysqli_query($link, $sql);
    ?>
    <script languaje="javascript" type='text/javascript'>
	alert("El modelo fue modificado correctamente :)");
	window.location='administrar.php?siteMap=subcategorias';
    </script>
<?php
}
mysqli_close($link);
}
?>