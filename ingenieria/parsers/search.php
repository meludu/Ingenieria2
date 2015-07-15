<?php
include("/../connect/clase_conexion.php");


if($_POST)
{

$q=htmlspecialchars($_POST['palabra'],ENT_QUOTES);//se recibe la cadena que queremos buscar

$sql_res=mysql_query("select * from productos where estado ='0' AND (nombre like '%$q%' or descripcionCorta like'%$q%') order by visitas DESC limit 4",$c);

$cantidadDePro = mysql_num_rows($sql_res);
if($cantidadDePro>0){

while($row=mysql_fetch_array($sql_res))
{
$idProducto=$row['idProducto'];
$nombre=$row['nombre'];
$descrip=$row['descripcionCorta'];
//$portada=$row['portada'];
//$tipo=$row['tipoPortada'];
?>

<a href="?op=publicacion&idP=<?php echo $idProducto; ?>"style="text-decoration:none;" >
<div class="display_box" align="left">
<div style="float:left; margin-right:6px;"><img  src="content/imagen_portada.php?idPro=<?php echo $row['idProducto']; ?>" width="60" height="60" /></div>

<div style="margin-right:6px;"><b class="titul"><?php echo utf8_encode($nombre); ?></b></div>

<div style="margin-right:6px; font-size:14px;" class="desc"><?php echo utf8_encode($descrip); ?></div></div>
</a>

<?php
}

?>	

<a  class="enlace" href="index.php?clave=<?php echo $q; ?>"> Ver mas..  </a> 

<?php
}
else{
	?>	

<b>  No se ha encontrado ninguna coincidencia </b> 

<?php
}
}

?>
