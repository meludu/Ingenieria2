<?php
	session_start();
	if ($_SESSION['estado'] == "online") {
		$id_user = $_SESSION['id'];
		$queryProductos = 'SELECT idProducto, nombre, descripcionCorta, visitas, fecha_ini, fecha_fin FROM productos WHERE idUsuario = '.$id_user;
		$result = mysqli_query($link,$queryProductos);
		$cantP = mysqli_num_rows($result);
		$n = 1;
?>
<div class="container">
  <div id="titleLoginSection">
    <center>
      <h2>
          <i class="fa fa-briefcase"></i> 
          Mis productos a la venta
      </h2>
    </center>  
  </div>
  <div class="well col-md-12">
  	<?php 
  		if ($cantP == 0) { ?>
  			<center><h2><p>No se disponen productos </p></h2></center>
  		<?php }else{
  	?>
  	<table class="table">
  		<tr>
  			<th>#</th><th>Producto</th><th><i class="fa fa-info"></i></th><th><i class="fa fa-eye"></i></th><th>Comienzo <i class="fa fa-calendar"></i></th><th>Fin <i class="fa fa-calendar"></i></th>
  		</tr>
	  <?php while ($tuplaProds = mysqli_fetch_array($result)) { ?>
	  	<tr style="background-color:#e8e8e8;">
	  		<td><?php echo $n; ?></td><td><a href="index.php?op=publicacion&idP=<?php echo $tuplaProds['idProducto'];?>"><?php echo utf8_encode($tuplaProds['nombre']); ?></a></td><td><?php echo utf8_encode($tuplaProds['descripcionCorta']);?></td><td><?php echo $tuplaProds['visitas'];?></td><td><?php echo $tuplaProds['fecha_ini'];?></td><td><?php echo $tuplaProds['fecha_fin'];?></td>
	  	</tr>
	  	<?php
	  	$n= $n + 1;
    	}
    	
	  } ?>    
	</table>
  </div>
</div>
<?php
	}else{ ?>
		<div class="alert alert-danger" role="alert">
      		<strong>Error!</strong>. No esta logueado, <a href="index.php">Volver al index</a>.
    	</div>
<?php }
?>