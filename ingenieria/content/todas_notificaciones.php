<?php
	if (isset($_SESSION['estado']) && $_SESSION['estado'] == "online") {
		$queryTodasNoti = "SELECT n.idNotificacion AS idNot, n.idProducto AS pro,n.mensaje AS msj, p.nombre AS titulo, n.fecha AS fec, u.nombre AS nom, u.apellido AS ape, n.estado AS est, n.hora AS h FROM notificaciones n INNER JOIN productos p ON(n.idProducto = p.idProducto) INNER JOIN usuarios u ON(n.idEmisor = u.idUsuario) WHERE idReceptor = '".$_SESSION['id']."' ORDER BY n.fecha DESC, n.hora DESC";
		$resTodasNoti = mysqli_query($link,$queryTodasNoti);
		$cantN = mysqli_num_rows($resTodasNoti);
		$n = 1;
    $cantColor = 0; // Para mostrar de otro color la tupla
?>
<div class="container">
  <div id="titleLoginSection">
    <center>
      <h2>
          <i class="fa fa-comment"></i>  
          Notificaciones
      </h2>
    </center>  
  </div>
  <div class="well col-md-12">
  	<?php 
  		if ($cantN == 0) { ?>
  			<center><h2><p>No dispones de notificaciones. </p></h2></center>
  		<?php }else{
  	?>
  	<table class="table">
  		<tr>
  			<th>#</th><th>Notificaci&oacute;n</th><th>Publicaci&oacute;n</th><th>Usuario</th><th>Fecha</th><td>Hora</td><th>Visto</th>
  		</tr>
	  <?php while ($tuplaNoti = mysqli_fetch_array($resTodasNoti)) { ?>
    <?php if (($cantColor % 2) == 0) { ?>
	  	<tr style="background-color:#E4E4E4;">
	  		<td><?php echo $n; ?></td><td><?php echo $tuplaNoti['msj']; ?></td><td><a href="index.php?op=modNoti&idP=<?php echo $tuplaNoti['pro']; ?>&idN=<?php echo $tuplaNoti['idNot']; ?>"><?php echo $tuplaNoti['titulo']; ?></a></td><td><?php echo $tuplaNoti['ape'].", ".$tuplaNoti['nom']; ?></td><td><?php echo $tuplaNoti['fec']; ?></td><td><?php echo $tuplaNoti['h']; ?></td><td><?php if ($tuplaNoti['est'] == 1) { echo "<stronge style='color:red;'>NO</stronge>"; }else{ echo "<stronge style='color:green;'>SI</stronge>"; } ?></td>
	  	</tr>
   <?php }else{ ?>
      <tr>
        <td><?php echo $n; ?></td><td><?php echo $tuplaNoti['msj']; ?></td><td><a href="index.php?op=modNoti&idP=<?php echo $tuplaNoti['pro']; ?>&idN=<?php echo $tuplaNoti['idNot']; ?>"><?php echo $tuplaNoti['titulo']; ?></a></td><td><?php echo $tuplaNoti['ape'].", ".$tuplaNoti['nom']; ?></td><td><?php echo $tuplaNoti['fec']; ?></td><td><?php echo $tuplaNoti['h']; ?></td><td><?php if ($tuplaNoti['est'] == 1) { echo "<stronge style='color:red;'>NO</stronge>"; }else{ echo "<stronge style='color:green;'>SI</stronge>"; } ?></td>
      </tr>
    <?php } ?>
	 <?php $n += 1; $cantColor += 1; ?>
	  <?php } ?>    
	</table>
	<?php
		} // fin else
	?>
  </div>
</div>
<?php
	}else{ ?>
		<script type="text/javascript">window.location="index.php"</script>
<?php }
?>