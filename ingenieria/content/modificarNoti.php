<?php
session_start();
include("/../connect/conexion.php");
$modNoti = "UPDATE notificaciones SET estado = '0' WHERE idNotificacion = '".$_GET['idN']."' ";
if(mysqli_query($link,$modNoti)){ ?>
	<script type="text/javascript">window.location="index.php?op=publicacion&idP="+<?php echo $_GET['idP']; ?>;</script>
<?php }?>