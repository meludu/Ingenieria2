<?php
session_start();

if ($_SESSION["estado"] == "online") {

if (isset($_GET["idCategoria"])){
	$id_categ_modif = $_GET["idCategoria"];
}

$categ_modif = utf8_decode($_POST["editarCategoriaTxt"]);

include("/../../connect/conexion.php");

$validar = "SELECT nombre_cat FROM categorias WHERE nombre_cat='$categ_modif'";
$ejec_validar = mysqli_query($link, $validar);

if ($reg_valida = mysqli_fetch_array($ejec_validar)){
    ?>
    <script languaje="javascript" type='text/javascript'>
        alert("ERROR, el nombre de la categoría que usted quiere poner ya está siendo usado!!");
        window.location='administrar.php?siteMap=categorias';
    </script>
<?php
}
else{
//Actualizar datos en la base de datos
$sql = "UPDATE categorias SET nombre_cat='$categ_modif' WHERE idCategoria='$id_categ_modif'";
//echo "$sql";
$res = mysqli_query($link, $sql);
?>
<script languaje="javascript" type='text/javascript'>
    alert("La categoría fue modificada correctamente :)");
    window.location='administrar.php?siteMap=categorias';
</script>
<?php
}
mysqli_close($link);
}
?>