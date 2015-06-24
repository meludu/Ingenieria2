<?php
session_start();
if ($_SESSION["estado"] == "online") {

$categ_nueva = utf8_decode($_POST["altaCategoriaTxt"]);

include("/../../connect/conexion.php");

//comprueba que el tipo que yo tipee no este ya en la tabla tipos.
$comprobar = "SELECT nombre_cat FROM categorias WHERE nombre_cat='$categ_nueva'";
$res_comprobar = mysqli_query($link, $comprobar);

//Si esta..
if ($comp = mysqli_fetch_array($res_comprobar)){
?>
    <script languaje="javascript" type='text/javascript'>
        alert("ERROR, la categoría que usted quiere agregar ya existe !!");
        window.location='administrar.php?siteMap=categorias';
    </script>
<?php
}
else{ //Sino...
    $insertar = "INSERT INTO categorias (nombre_cat) VALUES ('$categ_nueva')";
    $res_insertar = mysqli_query($link, $insertar);
    ?>
    <script languaje="javascript" type='text/javascript'>
        alert("Se dio de alta la categoría con éxito :)");
        window.location='administrar.php?siteMap=categorias';
    </script>
<?php
}
mysqli_close($link);
}
?>