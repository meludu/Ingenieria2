<?php
session_start();
if ($_SESSION["estado"] == "online") {

$subcateg = utf8_decode($_POST["altaSubCategoriaTxt"]);
$categoria = utf8_decode($_POST["categoriaSeleccionada"]);

include("/../../connect/conexion.php");

//comprueba que el tipo que yo tipee no este ya en la tabla tipos.
$comprobar = "SELECT nombre FROM subcategorias WHERE nombre='$subcateg'";
$res_comprobar = mysqli_query($link, $comprobar);

//Si esta..
if ($comp = mysqli_fetch_array($res_comprobar)){
?>
    <script languaje="javascript" type='text/javascript'>
        alert("ERROR, la subcategoría que usted quiere agregar ya existe !!");
        window.location='administrar.php?siteMap=subcategorias';
    </script>
<?php
}
else{ //Sino...
    $insertar = "INSERT INTO subcategorias (nombre,idCategoria) VALUES ('$subcateg','$categoria')";
    $res_insertar = mysqli_query($link, $insertar);
    ?>
    <script languaje="javascript" type='text/javascript'>
        alert("Se dio de alta la subcategoría con éxito :)");
        window.location='administrar.php?siteMap=subcategorias';
    </script>
<?php
}
mysqli_close($link);
}
?>