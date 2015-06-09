<?php
session_start();
if ($_SESSION["estado"] == "online") {

if (isset($_GET["idCategoria"])){
	$idCateg = $_GET["idCategoria"];
}

include("/../../connect/conexion.php");

//veo si esta en uso o no la categoría a dar de baja
$consul=" SELECT idCategoria FROM productos WHERE idCategoria='$idCateg'";
$res = mysqli_query($link, $consul);

if($fila = mysqli_fetch_array($res)){
?>
    <script languaje="javascript" type='text/javascript'>
        alert('La categoría que desea eliminar esta en uso, por favor para darla de baja seleccione una que no lo esté');
        window.location='administrar.php?siteMap=categorias';
    </script>
<?php
}

else {
    $eliminar = "DELETE FROM categorias WHERE idCategoria='$idCateg'";
    $res_eliminar = mysqli_query($link ,$eliminar);

    if($res_eliminar){
    ?>
        <script languaje="javascript" type="text/javascript">
            alert("La categoría ha sido eliminada con éxito :)");
            window.location='administrar.php?siteMap=categorias'
        </script>    
    <?php    
    }
    else{
    ?>
        <script languaje="javascript" type="text/javascript">
            alert("La categoría seleccionada no ha podido ser eliminada :(");
            window.location='administrar.php?siteMap=categorias'
        </script>
    <?php
    }   
}

mysqli_close($link);
}
?>