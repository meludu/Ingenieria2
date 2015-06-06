
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
      <form class="form-horizontal" role="form" enctype="multipart/form-data" action="helpers/subir_avatar.php" method="POST" >
        <div class="form-group">
          <label for="inputUserName" class="col-md-4 control-label"><i class="fa fa-pencil fa-2x"></i></label>
          <div class="col-md-4">
            <input type="text" value="<?php echo ($tuplaUser['nombre']); ?>" name="nombre" class="form-control" id="input-userName" placeholder="Nombre...">
          </div> <!-- End Form-->
        </div> <!-- End Form-->
        <div class="form-group">
          <label for="inputUserName" class="col-md-4 control-label"><i class="fa fa-pencil fa-2x"></i></label>
          <div class="col-md-4">
            <input type="text" name="apellido" value="<?php echo ($tuplaUser['apellido']); ?>" class="form-control" id="input-userName" placeholder="Apellido...">
          </div> <!-- End Form-->
        </div> <!-- End Form-->

        <div class="form-group">
          <label for="exampleInputFile" class="col-md-4 control-label"><i class="fa fa-camera fa-2x"></i></label>
            <div class="col-md-4">
              <input name="avatar" type="file" id="exampleInputFile" class="file-control" >
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
<?php } ?>