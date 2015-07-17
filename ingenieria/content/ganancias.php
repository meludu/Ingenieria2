<?php
    include("/../connect/conexion.php"); 
  session_start();
  if ($_SESSION['estado'] == "online") {
  
    $queryGanancias ='SELECT * FROM ganancias ';

    if (isset($_POST['fechaFinG']) && isset($_POST['fechaIniG'])){
          $fecha_ini=date('Y-m-d',strtotime($_POST['fechaIniG']));
          $fecha_fin=date('Y-m-d',strtotime($_POST['fechaFinG']));
      

          
          $queryGanancias = "SELECT * FROM ganancias WHERE fecha BETWEEN '".$fecha_ini."' and '".$fecha_fin."'"; 
    }else{
          $queryGanancias ='SELECT * FROM ganancias';
    }
    $result = mysqli_query($link,$queryGanancias);
    
   
    $cantG= mysqli_num_rows($result);
    $n = 0;
?>
<div id="page-content-wrapper">
<div class="container-fluid">
  <div id="titleLoginSection">
    <center>
      <h2>
          <i class="fa fa-usd"></i> 
          Mis Ganancias
      </h2>
    </center>  
  </div>
  <div class="col-xs-9 col-xs-offset-2 table-bordered">
    <?php 
      if($fecha_ini=='1970-01-01'){
        echo $fecha_ini;
      }
      if ($cantG == 0) { ?>
        <center><h2><p>No se dispone ganancias </p></h2></center>
        <a href="?siteMap=ganancias">Volver a buscar</a>

      <?php }
      else{
               
    ?>
 <div><center><h4>Filtrar entre fechas</h4></center></div>
    
      <form method="POST">
          <script src="http://cdn.jsdelivr.net/webshim/1.12.4/extras/modernizr-custom.js"></script>
<!-- polyfiller file to detect and load polyfills -->
          <script src="http://cdn.jsdelivr.net/webshim/1.12.4/polyfiller.js"></script>
          <script>
          webshims.setOptions('waitReady', false);
          webshims.setOptions('forms-ext', {types: 'date'});
          webshims.polyfill('forms forms-ext');
          </script>
          <div class="col-md-5">  
              <p>Desde<input type="date" name= "fechaIniG"></p>
          </div>

          <div class="col-md-5">
              <p>Hasta<input type="date" name= "fechaFinG"></p>
    
          </div>
          <button >Aceptar</button>
     </form>

    <table class="table table-bordered"  >
      <tr>
      <tr>
        <th>Id</th><th>Fecha</th><th>Producto</th><th>Vendedor</th><th>e-mail</th><th>Ganador</th><th>email</th><th>Precio</th><th>Mi ganancia</th>
      </tr>
    <?php while ($tuplaGanancias = mysqli_fetch_array($result)) { ?>
      <tr style="background-color:#e8e8e8;">
        <td ><?php echo $tuplaGanancias['idGanancia']; ?><td><?php echo date('d-m-Y',strtotime($tuplaGanancias['fecha']))?></th></td><td><p><?php echo utf8_encode($tuplaGanancias['nombre']); ?></p><td><?php $queryVendedor='SELECT nombre, apellido, idUsuario, email FROM usuarios WHERE idUsuario='.$tuplaGanancias['idVendedor']; $resVendedor = mysqli_query($link, $queryVendedor); $filaVendedor = mysqli_fetch_array($resVendedor); echo utf8_encode($filaVendedor['nombre']." ".$filaVendedor['apellido']);?></td><td><?php echo $filaVendedor['email'];?></td><td><?php $queryGanador='SELECT nombre, apellido, idUsuario, email FROM usuarios WHERE idUsuario='.$tuplaGanancias['idGanador']; $resGanador = mysqli_query($link, $queryGanador); $filaGanador = mysqli_fetch_array($resGanador); echo utf8_encode($filaGanador['nombre']." ".$filaGanador['apellido']);?></td><td><?php echo $filaGanador['email'];?></td><td> $<?php echo $tuplaGanancias['monto'];?></td><td>$<?php echo $tuplaGanancias['monto']*30/100;?></td>
      </tr>
      <?php
      $n= $n + $tuplaGanancias['monto']*30/100;
      }
      
    } ?>    
  </table>
<div>
    <?php
    if($n!=0){?>
    <tr>Mis ganancias: $<?php echo $n?></tr>  
 <?php
  }
  ?>
  </div>
  </div>
</div>
</div>
<?php
  }else{ ?>
    <div class="alert alert-danger" role="alert">
          <strong>Error!</strong>. No esta logueado, <a href="index.php">Volver al index</a>.
      </div>
<?php }
?>
