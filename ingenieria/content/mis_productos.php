<?php
	session_start();
	if ($_SESSION['estado'] == "online") {
		$id_user = $_SESSION['id'];
		$queryProductos = "SELECT idProducto, nombre, descripcionCorta, visitas, fecha_ini, fecha_fin, idGanador, estado FROM productos WHERE idUsuario = '".$id_user."' ORDER BY fecha_fin DESC";
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
        <th><i class="fa fa-info"></i> Descripci&oacute;n</th>
        <th><i class="fa fa-eye"></i></th>
        <th><i class="fa fa-calendar"></i> Inicio</th>
        <th><i class="fa fa-calendar"></i> Fin</th>
        <th>Estado</th>
        <th></th>
  		</thead>
      <tbody>
	  <?php while ($tuplaProds = mysqli_fetch_array($result)) { ?>
  	  	<tr style="background-color:#e8e8e8;">
          <?php
          $queryCantOfertas1 = 'SELECT COUNT(*) FROM ofertas o 
                          INNER JOIN usuarios u ON (o.idUsuario = u.idUsuario)
                          WHERE idProducto='.$tuplaProds['idProducto'];
          $ejec_cantOfer1 = mysqli_query($link, $queryCantOfertas1);
          $cantOfertas1 = mysqli_fetch_array($ejec_cantOfer1);
          ?>
  	  		<td><?php echo $n; ?></td>
          <td>
          <?php
          if ((interval_date($fechaActual[0], $tuplaProds['fecha_fin']) !== 'Publicaci&oacute;n finalizada.') && ($tuplaProds['estado'] == 0)){
            ?>
             <a href="index.php?op=publicacion&idP=<?php echo $tuplaProds['idProducto'];?>"><?php echo utf8_encode($tuplaProds['nombre']); ?></a>
          <?php
          }
          else {
            echo utf8_encode($tuplaProds['nombre']);
          }
          ?>
          </td>
          <td class="puntos"><?php echo utf8_encode($tuplaProds['descripcionCorta']);?></td>
          <td><?php echo $tuplaProds['visitas'];?></td>
          <td><?php echo $tuplaProds['fecha_ini'];?></td>
          <td><?php echo $tuplaProds['fecha_fin'];?></td>
          <td>
          <?php
          if (interval_date($fechaActual[0], $tuplaProds['fecha_fin']) === 'Publicaci&oacute;n finalizada.' || ($tuplaProds['estado'] == 1)) {
            if ($cantOfertas1[0] == 0){
              echo "<strong style='color:red;'>FINALIZADA</strong>";
            }
            else {
              if ($tuplaProds['idGanador'] == 0){
                echo "<strong style='color:orange;'>FINALIZADA</strong>";
              }
              else{
                echo "<strong style='color:red;'>FINALIZADA</strong>";
              }
            }
          }else{ 
            echo "<strong style='color:green;'>ACTIVA</strong>"; 
          } ?>  
          </td>
          <td>
          <!-- Boton ver ofertas--> 
          <a id="verOfertas_<?php echo $tuplaProds['idProducto'];?>" class="btn btn-primary <?php if ($tuplaProds['idGanador'] != 0) { echo 'hidden';}?>"  role="button" data-toggle="collapse" href="#ofertasId<?php echo $tuplaProds['idProducto'];?>" aria-expanded="false" aria-controls="ofertasId<?php echo $tuplaProds['idProducto'];?>">
            Ver Ofertas
          </a>
          <!-- Boton ver ganador-->
          <a id="verGanador_<?php echo $tuplaProds['idProducto'];?>" class="btn btn-success <?php if ($tuplaProds['idGanador'] == 0) { echo 'hidden';}?>"  role="button" data-toggle="collapse" href="#ganadorId<?php echo $tuplaProds['idProducto'];?>" aria-expanded="false" aria-controls="ganadorId<?php echo $tuplaProds['idProducto'];?>">
            Ver Ganador
          </a>          
          </td>
        </tr>
        <tr>
          <?php
          $queryOferta = 'SELECT o.oferta AS oferta, o.idProducto AS idProducto, o.precio AS precio, u.nombre AS nombre, u.apellido AS apellido, u.email AS email, o.idUsuario AS idUsuario FROM ofertas o 
                          INNER JOIN usuarios u ON (o.idUsuario = u.idUsuario)
                          WHERE o.idProducto='.$tuplaProds['idProducto'];
          $ejec_ofer = mysqli_query($link, $queryOferta);

          $queryCantOfertas = 'SELECT COUNT(*) FROM ofertas o 
                          INNER JOIN usuarios u ON (o.idUsuario = u.idUsuario)
                          WHERE idProducto='.$tuplaProds['idProducto'];
          $ejec_cantOfer = mysqli_query($link, $queryCantOfertas);
          $cantOfertas = mysqli_fetch_array($ejec_cantOfer);
          ?>
          <td id="ofertadoresParaProducto<?php echo $tuplaProds['idProducto'];?>" colspan=8 style="padding:0;">
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
                          <td class="puntos"><?php echo utf8_encode($result_ofer['oferta']);?></td>
                          <td>
                            <?php
                            $queryGanador = 'SELECT idGanador FROM productos WHERE idProducto='.$result_ofer['idProducto'];
                            $ejec_ganad = mysqli_query($link, $queryGanador);
                            while($tuplaGanador = mysqli_fetch_array($ejec_ganad)){
                              if (($tuplaGanador['idGanador'] == 0) && ($fechaActual[0] > $tuplaProds['fecha_fin'])){
                                ?>
                                <a type="button" data-prod="<?php echo $tuplaProds['idProducto'];?>" data-necesidad="<?php echo $result_ofer['oferta'];?>" data-monto="<?php echo $result_ofer['precio']?>" id="ganador_<?php echo $result_ofer['idUsuario'];?>" class="btn btn-primary elegirGanador" data-toggle='modal' data-target='.modalElegirGanador' >Elegir como ganador</a>     
                              <?php
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
            <div class="collapse" id="ganadorId<?php echo $tuplaProds['idProducto'];?>">
              <div class="well" style="border:none; padding-top:5px; padding-bottom:5px; padding-left:15px; padding-right:15px; margin-bottom:0;">
                <table class="table">
                  <thead style="background-color: #f5f5f5;">
                    <th>Ofertador</th>
                    <th>Email</th>
                    <th>Necesidad</th>
                    <th>Monto a pagar</th>
                  </thead>
                  <tbody style="background-color: #e8e8e8;">
                    <?php
                      $ejec_oferta = mysqli_query($link, $queryOferta);
                      while ($result_oferta = mysqli_fetch_array($ejec_oferta)){
                        $queryGanador2 = 'SELECT p.idGanador AS idGanador FROM productos p WHERE p.idProducto='.$result_oferta['idProducto'];
                        $ejec_user_ganad = mysqli_query($link, $queryGanador2);
                        while ($tuplaUserGanador = mysqli_fetch_array($ejec_user_ganad)){
                          if ($tuplaUserGanador['idGanador'] == $result_oferta['idUsuario']){
                          ?>
                          <tr class="radius-ultimo-hijo">
                            <td><?php echo utf8_encode($result_oferta['nombre'])." ".utf8_encode($result_oferta['apellido']);?></td>
                            <td><?php echo $result_oferta['email'];?></td>
                            <td class="puntos"><?php echo utf8_encode($result_oferta['oferta']);?></td>
                            <td><?php echo "$".$result_oferta['precio'];?></td>
                            <td>
                            </td>
                          </tr>
                          <?php
                          }
                        }
                      }
                    ?>
                  </tbody> 
                </table>
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
  var idGano;
  var idProd;
  var montoOferta;
  var necesidadProducto;
   $(".elegirGanador").click(function() {
      var values = $(this).attr('id').split("_");
      window.idGano = parseInt(values[1]);
      window.idProd = $(this).attr('data-prod');
      window.montoOferta = $(this).attr('data-monto');
      window.necesidadProducto = $(this).attr('data-necesidad');
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
            <button id="buttonSi" type="button" class="btn btn-primary" data-dismiss="modal">Si</button>
        </div>
      </div>
    </div>
  </div>
  <!-- END MODAL-->
  <script>
   $("#buttonSi").click(function() {
      var idProduc = window.idProd,
          idGano = window.idGano,
          monto = window.montoOferta,
          necesidad = window.necesidadProducto;

      $.post('content/elegirGanador.php',{
          idGanador:idGano, 
          idProducto:idProduc, 
          ofertaMonto: monto,
          necesidadUser: necesidad
      },function(response){
        console.log('success post');
        window.location='index.php?op=misProds';
        
      });
    });
  </script> 


<?php
	}else{ ?>
		<div class="alert alert-danger" role="alert">
      		<strong>Error!</strong>. No esta logueado, <a href="index.php">Volver al index</a>.
    	</div>
<?php }
?>
