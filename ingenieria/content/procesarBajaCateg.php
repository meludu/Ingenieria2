<?php
session_start();
if ($_SESSION["estado"] == "online") {

if (isset($_GET["idCategoria"])){
	$idCateg = $_GET["idCategoria"];
}

include("/../connect/conexion.php");
?>
<script>console.log('entro')</script>
<?php
//veo si esta en uso o no la categoría a dar de baja
$consul=" SELECT idCategoria FROM productos WHERE idCategoria='$idCateg'";
$res = mysqli_query($link, $consul);

if($fila = mysqli_fetch_array($res)){
    $value = 'false';
}

else {
    $eliminar = "DELETE FROM categorias WHERE idCategoria='$idCateg'";
    $res_eliminar = mysqli_query($link ,$eliminar);

    if($res_eliminar){    
        $value = 'true';
    }
    else{
        $value = 'false';
    }   
}
?>
<form name="sendErrorValue" method="post" action="administrar.php?siteMap=categorias">
    <input type="hidden" name="errorBaja" value="<?php echo $value?>">
</form>
<script languaje="javascript" type='text/javascript'>
    document.sendErrorValue.submit();
</script>
<?php
mysqli_close($link);
}
?>