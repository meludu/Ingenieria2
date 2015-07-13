<?php
session_start();
if ($_SESSION["estado"] == "online") {

$categ_nueva = utf8_decode($_POST["altaCategoriaTxt"]);

include("/../connect/conexion.php");

//comprueba que el tipo que yo tipee no este ya en la tabla tipos.
$comprobar = "SELECT nombre_cat FROM categorias WHERE nombre_cat='$categ_nueva'";
$res_comprobar = mysqli_query($link, $comprobar);

//Si esta..
if ($comp = mysqli_fetch_array($res_comprobar)){
    $value = 'true';
}
else{
   $insertar = "INSERT INTO categorias (nombre_cat) VALUES ('$categ_nueva')";
   $res_insertar = mysqli_query($link, $insertar); 
   $value = 'false';
}
?>
<form name="sendErrorValue" method="post" action="administrar.php?siteMap=categorias">
    <input type="hidden" name="errorAlta" value="<?php echo $value?>">
</form>
<script languaje="javascript" type='text/javascript'>
    document.sendErrorValue.submit();
</script>  

<?php
}
mysqli_close($link);
?>
