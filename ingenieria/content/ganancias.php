<?php
	  include("/../connect/conexion.php"); 
	session_start();
	if ($_SESSION['estado'] == "online") {
	
		$queryProductos ='SELECT * FROM productos WHERE idGanador<>0';
		$result = mysqli_query($link,$queryProductos);
		$cantP = mysqli_num_rows($result);
		$n = 1;
?>

<div class="container">
  <div id="titleLoginSection">
    <center>
      <h2>
          <i class="fa fa-briefcase"></i> 
          Mis Ganancias
      </h2>
    </center>  
  </div>
  <div class="well col-md-12" style="width:70%;">
  	<?php 
  		if ($cantP == 0) { ?>
  			<center><h2><p>No se disponen productos </p></h2></center>
  		<?php }else{
                $consultaFecha = "SELECT CURDATE()"; 
                $resFecha = mysqli_query($link,$consultaFecha); 
                $fechaActual = mysqli_fetch_array($resFecha); 
                include("../connect/calcular_fecha.php");
  	?>

  	<table class="table"  >
  		<tr>
  			<th>#</th><th>Producto</th><th>Vendedor</th><th>e-mail</th><th>Comienzo <i class="fa fa-calendar"></i></th><th>Fin <i class="fa fa-calendar"></i></th><th>Ganador</th>
  		</tr>
	  <?php while ($tuplaProds = mysqli_fetch_array($result)) { ?>
	  	<tr style="background-color:#e8e8e8;">
	  		<td ><?php echo $n; ?></td><td><p><?php echo utf8_encode($tuplaProds['nombre']); ?></p><td><?php $queryVendedor='SELECT nombre, apellido, idUsuario FROM usuarios WHERE idUsuario='.$tuplaProds['idUsuario']; $resVendedor = mysqli_query($link, $queryVendedor); $filaVendedor = mysqli_fetch_array($resVendedor); echo $filaVendedor['nombre']." ".$filaVendedor['apellido'];?></td><td><?php echo $filaVendedor['email'];?></td><td><?php echo $tuplaProds['fecha_ini'];?></td><td><?php echo $tuplaProds['fecha_fin'];?></td><td><?php $queryGanador='SELECT nombre, apellido, idUsuario FROM usuarios WHERE idUsuario='.$tuplaProds['idGanador']; $resGanador = mysqli_query($link, $queryGanador); $filaGanador = mysqli_fetch_array($resGanador); echo $filaGanador['nombre']." ".$filaGanador['apellido'];?></td>
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
