<?php

session_start();

if ($_SESSION["estado"] == "online") {

if (isset($_GET["idSubCategoria"])){
    $idsubcateg = $_GET["idSubCategoria"];
}

include("/../../connect/conexion.php");

//veo si esta en uso o no la subcategoria a dar de baja
$consul=" SELECT idProducto FROM productos WHERE idSubCategoria='$idsubcateg'";
$res = mysqli_query($link, $consul);

if($fila = mysqli_fetch_array($res)){
?>
    <script languaje="javascript" type='text/javascript'>
        alert('La subcategoría que desea eliminar esta en uso, por favor para darlo de baja seleccione uno que no lo esté');
        window.location='administrar.php?siteMap=subcategorias';
    </script>
<?php
}
else {
    $eliminar = "DELETE FROM subcategorias WHERE idSubCategoria='$idsubcateg'";
    $res_eliminar = mysqli_query($link, $eliminar);

    if($res_eliminar){
    ?>
        <script languaje="javascript" type="text/javascript">
            alert("La subcategoría ha sido eliminada con éxito :)");
            window.location='administrar.php?siteMap=subcategorias'
        </script>    
    <?php    
    }
    else{
    ?>
        <script languaje="javascript" type="text/javascript">
            alert("La subcategoría seleccionada no ha podido ser eliminada :(");
            window.location='administrar.php?siteMap=subcategorias'
        </script>
    <?php
    }   
}

mysqli_close($link);
}
?>