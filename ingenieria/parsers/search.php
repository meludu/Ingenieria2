<?php
include("/../connect/clase_conexion.php");


if($_POST)
{

$q=$_POST['palabra'];//se recibe la cadena que queremos buscar

$sql_res=mysql_query("select * from productos where nombre like '%$q%'",$c);

while($row=mysql_fetch_array($sql_res))
{
$idProducto=$row['idProducto'];
$nombre=$row['nombre'];
$descrip=$row['descripcionCorta'];
//$portada=$row['portada'];
//$tipo=$row['tipoPortada'];
?>

<a href="?op=producto" style="text-decoration:none;" >
<div class="display_box" align="left">
<div style="float:left; margin-right:6px;"><img  src="content/imagen_portada.php?idPro=<?php echo $row['idProducto']; ?>" width="60" height="60" /></div>

<div style="margin-right:6px;"><b><?php echo $nombre; ?></b></div>
<div style="margin-right:6px; font-size:14px;" class="desc"><?php echo $descrip; ?></div></div>
</a>

<?php
}

}
else
{

}


?>
