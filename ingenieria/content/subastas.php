<?php
	session_start();
	if (($_SESSION['estado'] == "online") && ($_SESSION['user'] == 'admin')){
		//$id_user = $_SESSION['id'];
  		$queryProductos = 'SELECT idProducto, nombre, descripcionCorta, visitas, fecha_ini, fecha_fin, idUsuario FROM productos' ;		
      $result = mysqli_query($link,$queryProductos);
  		$cantP = mysqli_num_rows($result);
  		$n = 1;


  ?>
  <div class="container">
    <div id="titleLoginSection">
      <center>
        <h2>
            <i class="fa fa-shopping-cart"></i>
            Todas las subastas
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
    			<th>#</th><th>Producto</th><th>Informaci&oacute;n</th><th>Due&ntilde;o de producto</th><th>Email</th>
    		</tr>
  	  <?php while ($tuplaProds = mysqli_fetch_array($result)) { 
        $queryUsuarios = 'SELECT idUsuario, nombre, apellido, email FROM usuarios WHERE idUsuario='.$tuplaProds['idUsuario'];
        $resultUsuarios = mysqli_query($link, $queryUsuarios);
        $filaUsers = mysqli_fetch_array($resultUsuarios);
        ?>
  	  	<tr style="background-color:#e8e8e8;">
  	  		<td><?php echo $n; ?></td><td><a href="index.php?op=publicacion&idP=<?php echo $tuplaProds['idProducto'];?>"><?php echo utf8_encode($tuplaProds['nombre']); ?></a></td><td><?php echo utf8_encode($tuplaProds['descripcionCorta']);?></td><td><?php echo $filaUsers['nombre'];?> <?php echo $filaUsers['apellido'];?></td><td><?php echo $filaUsers['email'];?></td>
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
        		<strong>Error!</strong>. Ha ocurrido un error inesperado, <a href="index.php">Volver al index</a>.
      	</div>
  <?php 
  }
  ?>