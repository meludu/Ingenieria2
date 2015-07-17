<?php
    if (isset($_SESSION['estado']) && $_SESSION['estado'] == "online") {
    	// Esta consulta trae todas las notificaciones del usuario logeados que esten en estado 1 (que no la haya visto).
        $queryNoti = "SELECT * FROM notificaciones WHERE idReceptor = '".$_SESSION['id']."' AND estado = '1' ORDER BY fecha DESC, hora DESC LIMIT 4";
        $resNoti = mysqli_query($link,$queryNoti);
        $posNoti = 1;
    }   
?>

<div id="target" class="noti" style="right: 5px; z-index: 9999; padding: 5px; background-color: #D7D5D5;">
		<?php while ($tuplaNoti = mysqli_fetch_array($resNoti)) { ?>
			<a href="?op=modNoti&idP=<?php echo $tuplaNoti['idProducto'];?>&idN=<?php echo $tuplaNoti['idNotificacion'];?>" style="text-decoration:none; color:black;"><div class="display_noti"><?php echo utf8_encode($tuplaNoti['mensaje']); ?></div></a>
			<hr>
		<?php } ?>
		<a href="?op=allNoti" style="text-decoration:none; color:black;"><div class="display_noti">Ver mas.</div></a>
</div>