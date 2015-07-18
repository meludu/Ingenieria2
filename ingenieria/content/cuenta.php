
<?php
if (isset($_SESSION['estado']) && $_SESSION['estado'] == "online") { // Para entrar aca hay que iniciar session
  $queryUser = "SELECT * FROM usuarios WHERE email = '".$_SESSION['user']."' ";
  $resUser = mysqli_query($link,$queryUser);
  $tuplaUser = mysqli_fetch_array($resUser);
  ?>
  <div class="container">
    <div id="titleLoginSection">
      <center>
        <h2>
            <i class="fa fa-cog"></i>  
            Mi cuenta
        </h2>
      </center>  
    </div>
    <div class="well col-md-6 col-md-offset-3">

      <!-- PRIMER FORMULARIO DE DATOS PERSONALES -->
      <div id="titleLoginSection" style="text-align: center">
        <h4>Datos personales</h4>
      </div>
      <form class="form-horizontal" role="form" enctype="multipart/form-data" action="helpers/subir_avatar.php" method="POST" data-parsley-validate >
        <div class="form-group">
          <label for="inputUserName" class="col-md-4 control-label"><i class="fa fa-pencil fa-2x"></i></label>
          <div class="col-md-4">
            <input type="text" value="<?php echo utf8_encode($tuplaUser['nombre']); ?>" name="nombre" class="form-control" id="input-userName" placeholder="Nombre..." required>
          </div> <!-- End Form-->
        </div> <!-- End Form-->
        <div class="form-group">
          <label for="inputUserName" class="col-md-4 control-label"><i class="fa fa-pencil fa-2x"></i></label>
          <div class="col-md-4">
            <input type="text" name="apellido" value="<?php echo utf8_encode($tuplaUser['apellido']); ?>" class="form-control" id="input-userName" placeholder="Apellido..." required>
          </div> <!-- End Form-->
        </div> <!-- End Form-->

        <div class="form-group">
          <label for="inputUserName" class="col-md-4 control-label"><i class="fa fa-pencil fa-2x"></i></label>
          <div class="col-md-4">
            <input type="radio" name="sexo" id="genderM" value="Masculino"  <?php if ($tuplaUser['sexo'] == "Masculino") { echo 'checked="checked"'; } ?> required /> Masculino
            <br>
            <input type="radio" name="sexo" id="genderF" value="Femenino" <?php if ($tuplaUser['sexo'] == "Femenino") { echo 'checked="checked"'; } ?>  /> Femenino  
          </div> <!-- End Form-->
        </div> <!-- End Form-->


        <script src="http://cdn.jsdelivr.net/webshim/1.12.4/polyfiller.js"></script>
          <script>
          webshims.setOptions('waitReady', false);
          webshims.setOptions('forms-ext', {types: 'date'});
          webshims.polyfill('forms forms-ext');
        </script>
        <div class="form-group">
          <label for="inputUserName" class="col-md-4 control-label"><i class="fa fa-pencil fa-2x"></i></label>
          <div class="col-md-4">
            <input type="date" name="fecha" value="<?php echo $tuplaUser['fecha_nac']; ?>" class="form-control" id="input-userName" required>
          </div> <!-- End Form-->
        </div> <!-- End Form-->


        <div class="form-group">
          <label for="exampleInputFile" class="col-md-4 control-label"><i class="fa fa-camera fa-2x"></i></label>
            <div class="col-md-4">
              <input name="avatar" type="file" id="disabledInput" class="file-control" disabled>
              <p class="help-block">Subir foto.</p>
            </div>
        </div>
        <div class="form-group">
          <div class="col-md-offset-4">
            <button type="submit" class="btn btn-success">Actualizar</button>
            <button type="reset" class="btn btn-danger">Borrar</button>
          </div> <!-- End Div that content buttons-->
        </div> <!-- End Div-->
      </form><!-- End Form-->
  </div>
  </div>
<?php 
}
else{
?>
  <div class="alert alert-danger" role="alert">
    <strong>Error!</strong>, debe estar logueado para acceder a esta p&aacute;gina. 
    <a href="index.php?op=login" class="alert-link">Ir a login de la pagina</a>.
  </div>
<?php 
}
?>
