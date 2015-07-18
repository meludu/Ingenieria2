<?php
	
	if (isset($_SESSION['estado']) && $_SESSION['estado'] == "online") { 

		$queryOfer = "SELECT p.nombre AS producto, o.oferta AS oferta, o.precio AS precio, o.fecha AS fecha, o.hora AS hora, p.fecha_fin AS fecFin, p.estado AS estP, p.idProducto AS idP FROM ofertas o INNER JOIN productos p ON(o.idProducto = p.idProducto) WHERE o.idUsuario = '".$_SESSION['id']."' ORDER BY o.fecha DESC, o.hora DESC ";
		$resOfer = mysqli_query($link,$queryOfer);
		$cantO = mysqli_num_rows($resOfer);
?>

<div class="container">
	<div id="titleLoginSection">
    	<center>
    		<h2><i class="fa fa-comment"></i>Ofertas realizadas</h2></center>  
    </div>
    <br>
  	<div class="well col-md-12">
  	<?php 
  		if ($cantO == 0) { ?>
  			<center><h2><p>No realizaste ninguna oferta. </p></h2></center>
  		<?php
  		}else{
  			$numFila = 1;
  			$cantColor = 0;

  			// fecha actual de la BD
  			$queryFechaAct = "SELECT CURDATE()";
  			$resFechaAct = mysqli_query($link,$queryFechaAct);
  			$fechaAct = mysqli_fetch_array($resFechaAct);
  	?>
  	<table class="table">
  		<tr>
  			<th>#</th><th>Publicaci&oacute;n</th><th>Necesidad</th><th>Monto</th><th><i class="fa fa-calendar"></i> Fecha</th><th><i class="fa fa-clock-o"></i> Hora</th><th>Estado</th>
  		</tr>
	  	<?php while ($tuplaOfer = mysqli_fetch_array($resOfer)) { ?>
    	<?php if (($cantColor % 2) == 0) { ?>
	  	<tr style="background-color:#E4E4E4;">
	  		<td><?php echo $numFila; ?></td><td><?php if ($tuplaOfer['estP'] == 0 && $fechaAct[0] <= $tuplaOfer['fecFin']) { echo '<a href="index.php?op=publicacion&idP='.$tuplaOfer['idP'].'">'.utf8_encode($tuplaOfer['producto']).'</a>'; }else{ echo utf8_encode($tuplaOfer['producto']); } ?></td><td><?php echo utf8_encode($tuplaOfer['oferta']); ?></td><td><?php echo "$ ".utf8_encode($tuplaOfer['precio']); ?></td><td><?php echo $tuplaOfer['fecha']; ?></td><td><?php echo $tuplaOfer['hora']; ?></td><td><?php if ($tuplaOfer['estP'] == 0 && $fechaAct[0] <= $tuplaOfer['fecFin']) { echo "<strong style='color: green;'>ACTIVA</strong>"; }else{ echo "<strong style='color: red;'>FINALIZADA</strong>"; } ?></td>
	  	</tr>
   		<?php 
   		}else{ ?>
      	<tr>
        	<td><?php echo $numFila; ?></td><td><?php if ($tuplaOfer['estP'] == 0 && $fechaAct[0] <= $tuplaOfer['fecFin']) { echo '<a href="index.php?op=publicacion&idP='.$tuplaOfer['idP'].'">'.utf8_encode($tuplaOfer['producto']).'</a>'; }else{ echo utf8_encode($tuplaOfer['producto']); } ?></td><td><?php echo utf8_encode($tuplaOfer['oferta']); ?></td><td><?php echo "$ ".utf8_encode($tuplaOfer['precio']); ?></td><td><?php echo $tuplaOfer['fecha']; ?></td><td><?php echo $tuplaOfer['hora']; ?></td><td><?php if ($tuplaOfer['estP'] == 0 && $fechaAct[0] <= $tuplaOfer['fecFin']) { echo "<strong style='color: green;'>ACTIVA</strong>"; }else{ echo "<strong style='color: red;'>FINALIZADA</strong>"; } ?></td>
      	</tr>
    <?php } ?>
	 <?php $numFila += 1; $cantColor += 1; ?>
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
	<?php
	}
?>