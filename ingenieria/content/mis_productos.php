<?php
	session_start();
	if ($_SESSION['estado'] == "online") {
		$id_user = $_SESSION['id'];
		$queryProductos = 'SELECT idProducto, nombre, descripcionCorta, visitas, fecha_ini, fecha_fin, idGanador FROM productos WHERE idUsuario = '.$id_user;
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
  		<?php 
      }else{
        $consultaFecha = "SELECT CURDATE()"; 
        $resFecha = mysqli_query($link,$consultaFecha); 
        $fechaActual = mysqli_fetch_array($resFecha); 
        include_once("connect/calcular_fecha.php");
  	?>
  	<table class="table">
  		<thead>
  			<th>#</th>
        <th>Producto</th>
        <th><i class="fa fa-info"></i></th>
        <th><i class="fa fa-eye"></i></th>
        <th><i class="fa fa-calendar"></i> Inicio</th>
        <th><i class="fa fa-calendar"></i> Fin</th>
        <th>Estado</th>
        <th></th>
  		</thead>
      <tbody>
	  <?php while ($tuplaProds = mysqli_fetch_array($result)) { ?>
  	  	<tr style="background-color:#e8e8e8;">
  	  		<td><?php echo $n; ?></td>
          <td><a href="index.php?op=publicacion&idP=<?php echo $tuplaProds['idProducto'];?>"><?php echo utf8_encode($tuplaProds['nombre']); ?></a></td>
          <td><?php echo utf8_encode($tuplaProds['descripcionCorta']);?></td>
          <td><?php echo $tuplaProds['visitas'];?></td>
          <td><?php echo $tuplaProds['fecha_ini'];?></td>
          <td><?php echo $tuplaProds['fecha_fin'];?></td>
          <td><?php if (interval_date($fechaActual[0], $tuplaProds['fecha_fin']) === 'Publicaci&oacute;n finalizada.') {
           echo "<strong style='color:red;'>FINALIZADA</strong>";
            }else{ 
              echo "<strong style='color:green;'>ACTIVA</strong>"; } ?>
          </td>
          <td>
          <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#ofertasId<?php echo $tuplaProds['idProducto'];?>" aria-expanded="false" aria-controls="ofertasId<?php echo $tuplaProds['idProducto'];?>">
            Ver Ofertas
          </button>
          </td>
        </tr>
        <tr>
          <?php
          $queryOferta = 'SELECT o.oferta AS oferta, o.idProducto AS idProducto, o.precio AS precio, u.nombre AS nombre, u.apellido AS apellido, u.email AS email, u.idUsuario AS idUsuario FROM ofertas o 
                          INNER JOIN usuarios u ON (o.idUsuario = u.idUsuario)
                          WHERE idProducto='.$tuplaProds['idProducto'];
          $ejec_ofer = mysqli_query($link, $queryOferta);

          $queryCantOfertas = 'SELECT COUNT(*) FROM ofertas o 
                          INNER JOIN usuarios u ON (o.idUsuario = u.idUsuario)
                          WHERE idProducto='.$tuplaProds['idProducto'];
          $ejec_cantOfer = mysqli_query($link, $queryCantOfertas);
          $cantOfertas = mysqli_fetch_array($ejec_cantOfer);
          ?>
          <td colspan=8 style="padding:0;">
            <div class="collapse" id="ofertasId<?php echo $tuplaProds['idProducto'];?>">
              <div class="well" style="border:none; padding-top:5px; padding-bottom:5px; padding-left:15px; padding-right:15px; margin-bottom:0;">
              <?php
                if($cantOfertas[0] > 0){
                ?>
                <table class="table">
                  <thead style="background-color: #f5f5f5;">
                    <th>Ofertador</th>
                    <th>Email</th>
                    <th>Necesidad</th>
                    <th>Monto a pagar</th>
                    <th></th>
                  </thead>
                  <tbody style="background-color: #e8e8e8;">
                    <?php
                    
                      while ($result_ofer = mysqli_fetch_array($ejec_ofer)){
                        $num_row = 1;
                    
                        ?>
                        <tr class="radius-ultimo-hijo">
                          <td><?php echo utf8_encode($result_ofer['nombre'])." ".utf8_encode($result_ofer['apellido']);?></td>
                          <td><?php echo $result_ofer['email'];?></td>
                          <td><?php echo utf8_encode($result_ofer['oferta']);?></td>
                          <td><?php echo "$".$result_ofer['precio'];?></td>
                          <td>
                            <?php
                            $queryGanador = 'SELECT idGanador FROM productos WHERE idProducto='.$result_ofer['idProducto'];
                            $ejec_ganad = mysqli_query($link, $queryGanador);
                            //$tuplaGanador = mysqli_fetch_array($ejec_ganad);
                            while($tuplaGanador = mysqli_fetch_array($ejec_ganad)){
                              if ($tuplaGanador['idGanador'] == 0){
                                ?>
                                <a type="button" id="ganador_<?php echo $result_ofer['idUsuario'];?>" class="btn btn-primary elegirGanador" data-toggle='modal' data-target='.modalElegirGanador' >Elegir como ganador</a>
                                <span id="contentNombreGanador<?php echo $result_ofer['idUsuario'];?>"></span>
                              <?php
                              }else{
                                //En caso de que IdGanador no sea 0, quiere decir que ya existe uno.
                                //se imprime que el ofertador de la fila es el que esta marcado como ganador. Solamente él!
                                if ($tuplaGanador['idGanador'] === $result_ofer['idUsuario']){
                                  ?>
                                  <div><?php echo 'Este usuario <strong>ha sido elegido como ganador!</strong>';?></div>
                                <?php
                                }
                                else {
                                  ?>
                                  <script>

                                  </script>
                                <?php
                                }
                              }
                            }
                            ?>
                          </td>
                        </tr>
                        <?php
                        $num_row = $num_row + 1;
                      }
                    ?>
                  </tbody> 
                </table>
                <?php
                }
                else{
                  ?>
                  <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    No hay ofertas para este producto
                  </div>
                <?php
                }
                ?>
              </div>
            </div>
          </td>
        </tr>
      </tbody>
	  	<?php
	  	$n= $n + 1;
    	}
	  } ?>    
	</table>
  </div>
</div>
<script>
   $(".elegirGanador").click(function() {
      var values = $(this).attr('id').split("_"),
        idGano = parseInt(values[1]),
        botonElegirGanador = $(this).attr('id'); 
      $.post('content/elegirGanador.php',{idGanador:idGano},function(response){
        $('#eligioGanador').html(response);
      });
    }); 
</script>

<!-- BEGIN MODAL-->
  <div class="modal fade modalElegirGanador" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          Est&aacute; seguro que desea elegir a esta oferta como la ganadora?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            <span id="eligioGanador"></span>
        </div>
      </div>
    </div>
  </div>
  <!-- END MODAL-->
<?php
	}else{ ?>
		<div class="alert alert-danger" role="alert">
      		<strong>Error!</strong>. No esta logueado, <a href="index.php">Volver al index</a>.
    	</div>
<?php }
?>
