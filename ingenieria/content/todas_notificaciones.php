<?php
	if (isset($_SESSION['estado']) && $_SESSION['estado'] == "online") {

    // Consulta por defecto.
    $queryOrder = "SELECT n.idNotificacion AS idNot, n.idProducto AS pro,n.mensaje AS msj, p.nombre AS titulo, n.fecha AS fec, u.nombre AS nom, u.apellido AS ape, n.estado AS est, n.hora AS h, p.estado AS estP FROM notificaciones n INNER JOIN productos p ON(n.idProducto = p.idProducto) INNER JOIN usuarios u ON(n.idEmisor = u.idUsuario) WHERE idReceptor = '".$_SESSION['id']."' ORDER BY n.fecha DESC, n.hora DESC";
    
    // Consultas ordenas segun el parametro
    if (isset($_GET['orden'])) {
      switch ($_GET['orden']) {
        case 'preguntas':
          $queryOrder ='SELECT n.idNotificacion AS idNot, n.idProducto AS pro,n.mensaje AS msj, p.nombre AS titulo, n.fecha AS fec, u.nombre AS nom, u.apellido AS ape, n.estado AS est, n.hora AS h, p.estado AS estP FROM notificaciones n INNER JOIN productos p ON(n.idProducto = p.idProducto) INNER JOIN usuarios u ON(n.idEmisor = u.idUsuario) WHERE idReceptor = '.$_SESSION['id'].' AND n.mensaje LIKE "%ah respondido tu pregunta%" ORDER BY n.fecha DESC, n.hora DESC';
          break;
        case 'respuestas':
          $queryOrder = 'SELECT n.idNotificacion AS idNot, n.idProducto AS pro,n.mensaje AS msj, p.nombre AS titulo, n.fecha AS fec, u.nombre AS nom, u.apellido AS ape, n.estado AS est, n.hora AS h, p.estado AS estP FROM notificaciones n INNER JOIN productos p ON(n.idProducto = p.idProducto) INNER JOIN usuarios u ON(n.idReceptor = u.idUsuario) WHERE n.idEmisor = '.$_SESSION['id'].' AND n.mensaje LIKE "% ah respondido tu pregunta en %" ORDER BY n.fecha DESC, n.hora DESC';
          break;
        default:
          $queryOrder = "SELECT n.idNotificacion AS idNot, n.idProducto AS pro,n.mensaje AS msj, p.nombre AS titulo, n.fecha AS fec, u.nombre AS nom, u.apellido AS ape, n.estado AS est, n.hora AS h, p.estado AS estP FROM notificaciones n INNER JOIN productos p ON(n.idProducto = p.idProducto) INNER JOIN usuarios u ON(n.idEmisor = u.idUsuario) WHERE idReceptor = '".$_SESSION['id']."' ORDER BY n.fecha DESC, n.hora DESC";
          break;
      }
    }

		//$queryTodasNoti = "SELECT n.idNotificacion AS idNot, n.idProducto AS pro,n.mensaje AS msj, p.nombre AS titulo, n.fecha AS fec, u.nombre AS nom, u.apellido AS ape, n.estado AS est, n.hora AS h, p.estado AS estP FROM notificaciones n INNER JOIN productos p ON(n.idProducto = p.idProducto) INNER JOIN usuarios u ON(n.idEmisor = u.idUsuario) WHERE idReceptor = '".$_SESSION['id']."' ORDER BY n.fecha DESC, n.hora DESC";
		$resTodasNoti = mysqli_query($link,$queryOrder);
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
    <div>
      <a href="index.php?op=allNoti" class="btn btn-default" title="Todas"><i class="fa fa-archive"></i></a>
      <a href="index.php?op=allNoti&orden=preguntas" class="btn btn-default" title="Mis preguntas"><i class="fa fa-comments"></i></a>
      <a href="index.php?op=allNoti&orden=respuestas" class="btn btn-default" title="Mis respuestas"><i class="fa fa-comments-o"></i></a>
      <a href="" class="btn btn-default" title="Publicaciones ganadas"><i class="fa fa-gavel"></i></a>
    </div>
    <br>
  	<table class="table">
  		<tr>
  			<th>#</th><th>Notificaci&oacute;n</th><th>Publicaci&oacute;n</th><th>Usuario</th><th>Fecha</th><th>Hora</th><th>Visto</th>
  		</tr>
	  <?php while ($tuplaNoti = mysqli_fetch_array($resTodasNoti)) { ?>
    <?php if (($cantColor % 2) == 0) { ?>
	  	<tr style="background-color:#E4E4E4;">
	  		<td><?php echo $n; ?></td><td><?php echo utf8_encode($tuplaNoti['msj']); ?></td><td><?php if ($tuplaNoti['estP'] == 0) { ?><a href="index.php?op=modNoti&idP=<?php echo utf8_encode($tuplaNoti['pro']); ?>&idN=<?php echo $tuplaNoti['idNot']; ?>"><?php echo utf8_encode($tuplaNoti['titulo']); ?></a><?php }else{ mysqli_query($link,"UPDATE notificaciones SET estado = '0' WHERE idNotificacion = '".$tuplaNoti['idNot']."' "); echo utf8_encode($tuplaNoti['titulo']); } ?></td><td><?php echo utf8_encode($tuplaNoti['ape']).", ".utf8_encode($tuplaNoti['nom']); ?></td><td><?php echo $tuplaNoti['fec']; ?></td><td><?php echo $tuplaNoti['h']; ?></td><td><?php if ($tuplaNoti['est'] == 1) { echo "<stronge style='color:red;'>NO</stronge>"; }else{ echo "<stronge style='color:green;'>SI</stronge>"; } ?></td>
	  	</tr>
   <?php }else{ ?>
      <tr>
        <td><?php echo $n; ?></td><td><?php echo utf8_encode( $tuplaNoti['msj']); ?></td><td><?php if ($tuplaNoti['estP'] == 0) { ?><a href="index.php?op=modNoti&idP=<?php echo utf8_encode($tuplaNoti['pro']); ?>&idN=<?php echo $tuplaNoti['idNot']; ?>"><?php echo utf8_encode($tuplaNoti['titulo']); ?></a><?php }else{ mysqli_query($link,"UPDATE notificaciones SET estado = '0' WHERE idNotificacion = '".$tuplaNoti['idNot']."' "); echo utf8_encode($tuplaNoti['titulo']); } ?></td><td><?php echo utf8_encode($tuplaNoti['ape']).", ".utf8_encode($tuplaNoti['nom']); ?></td><td><?php echo $tuplaNoti['fec']; ?></td><td><?php echo $tuplaNoti['h']; ?></td><td><?php if ($tuplaNoti['est'] == 1) { echo "<stronge style='color:red;'>NO</stronge>"; }else{ echo "<stronge style='color:green;'>SI</stronge>"; } ?></td>
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