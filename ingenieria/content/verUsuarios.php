<?php
    include("/../connect/conexion.php"); 
  session_start();
  if ($_SESSION['estado'] == "online") {
  
    $queryUsuarios ='SELECT * FROM usuarios';
    if (isset($_POST['fechaFin']) && isset($_POST['fechaIni'])){
          $fecha_ini=date('Y-m-d',strtotime($_POST['fechaIni']));
          $fecha_fin=date('Y-m-d',strtotime($_POST['fechaFin']));
      

          
          $queryUsuarios = "SELECT * FROM usuarios WHERE fecha_registro BETWEEN '".$fecha_ini."' and '".$fecha_fin."'"; 
    }else{
          $queryUsuarios ='SELECT * FROM usuarios';
    }
    $result = mysqli_query($link,$queryUsuarios);
    
   
    $cantU = mysqli_num_rows($result);
    $n = 0;
?>
<div id="page-content-wrapper">
<div class="container-fluid">
  <div id="titleLoginSection">
    <center>
      <h2>
          <i class="fa fa-user"></i> 
          Usuarios
      </h2>
    </center>  
  </div>

  <div class="col-xs-9 col-xs-offset-2 table-bordered">
    <?php 
      if ($cantU == 0) { ?>
        <center><h2><p>No se dispone de usuarios </p></h2></center>
         <a href="?siteMap=registroUsuario">Volver a buscar</a>
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

            <p>Desde<input type="date" name= "fechaIni"></p>
          </div>

          <div class="col-md-5">
            <p>Hasta<input type="date" name= "fechaFin"></p>
    
          </div>
         
          <button >Aceptar</button>
      </form>

    <table class="table table-bordered"  >
      <tr>
        <th>Id </th><th>Usuario</th><th>e-mail</th><th>Fecha Ingreso <i class="fa fa-calendar"></i></th><th>Estado</th>
      </tr>
    <?php while ($tuplaUser = mysqli_fetch_array($result)) { ?>
      <tr style="background-color:#e8e8e8;">
        <td><p><?php echo utf8_encode($tuplaUser['idUsuario']); ?></p><td><?php $queryUsuarios='SELECT nombre, apellido, idUsuario FROM usuarios WHERE idUsuario='.$tuplaUser['idUsuario']; $resUsuario = mysqli_query($link, $queryUsuarios); $filaUsuario = mysqli_fetch_array($resUsuario); echo utf8_encode($filaUsuario['nombre']." ".$filaUsuario['apellido']);?></td><td><?php echo $tuplaUser['email'];?></td><td><?php echo date('d-m-Y',strtotime( $tuplaUser['fecha_registro']));?></td>
        <td>
        <?php
        if($tuplaUser['estado']==1){
            echo "<strong style='color:red;'>ELIMINADO</strong>";
            }else{ 
              echo "<strong style='color:green;'>ACTIVO</strong>"; 
            } ?>


        </td>
      </tr>
      <?php
      $n= $n + 1;
      }
      
    } ?>    
  </table>
<div>
   <?php
    if($n!=0){?>
    <tr>Canrtidad de Usuarios: <?php echo $n?></tr>  
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
