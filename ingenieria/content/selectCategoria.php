<?php

include("/../../connect/conexion.php");

$ordenar = "SELECT * FROM categorias ORDER BY nombre_cat";
$ejec_ordenar = mysqli_query($link, $ordenar);

while ($registro = mysqli_fetch_array($ejec_ordenar)){
    $categoria = utf8_encode($registro["nombre_cat"]);
    $idcategoria = $registro["idCategoria"];
    echo "<option value='$idcategoria'>$categoria</option>";
}
    
?>