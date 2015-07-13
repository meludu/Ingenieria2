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
            Configuraci&oacute;n
        </h2>
      </center>  
    </div>
    <div class="well col-md-6 col-md-offset-3">

      <!-- PRIMER FORMULARIO DE DATOS PERSONALES -->
      <div id="titleLoginSection" style="text-align: center">
        <h4>Actualiza sus datos. </h4>
      </div>
      <form class="form-horizontal" role="form" action="content/cambiar_clave.php" method="POST" name="formPass" data-parsley-validate>
        <div class="form-group">
          <label for="inputUserName" class="col-md-4 control-label"><i class="fa fa-pencil fa-2x"></i></label>
          <div class="col-md-4">
            <input type="password" name="viejopass" class="form-control" id="inputPass0" placeholder="Contrase&ntilde;a vieja..." data-parsley-trigger="change" data-parsley-minlength="8" required>
          </div> <!-- End Form-->
        </div> <!-- End Form-->

        <div class="form-group">
          <label for="inputUserName" class="col-md-4 control-label"><i class="fa fa-pencil fa-2x"></i></label>
          <div class="col-md-4">
            <input type="password" name="nuevopass1" class="form-control" id="inputPass" placeholder="Contrase&ntilde;a nueva..." data-parsley-trigger="change" data-parsley-minlength="8" required>
          </div> <!-- End Form-->
        </div> <!-- End Form-->

         <div class="form-group">
          <label for="inputUserName" class="col-md-4 control-label"><i class="fa fa-pencil fa-2x"></i></label>
          <div class="col-md-4">
            <input type="password" name="nuevopass2" class="form-control" id="inputPass2" placeholder="Repetir contrase&ntilde;a..." data-parsley-trigger="change" data-parsley-minlength="8" data-parsley-equalto="#inputPass" required>
          </div> <!-- End Form-->
        </div> <!-- End Form-->

        <div class="form-group">
          <div class="col-md-offset-4">
            <button type="submit" class="btn btn-success">Actualizar</button>
            <button type="reset" class="btn btn-danger">Vaciar</button>
          </div> <!-- End Div that content buttons-->
        </div> <!-- End Div-->
      </form><!-- End Form-->

      <?php
        if ($_SESSION['tipo'] == 'usuario') { ?>
        <div class="form-group" >
          <div class="col-md-offset-3">
            <h4>¿Quiere borrar su cuenta? <button name="btn_borrarCuenta" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Borrar</button><?php require("boton_borrar.php"); ?></h4>
          </div> <!-- End Div that content buttons-->
        </div> <!-- End Div-->

        
        <?php 
          if (isset($_GET['error'])) {
          if (base64_decode($_GET['error']) == 'Error al eliminar') { ?>
            <!-- Error al eliminar el usuario. -->
            <div id="errorBajaUser" class="col-xs-9 col-md-8 col-xs-offset-2" >
              <div class="alert alert-danger" role="alert">
                <p>Error al tratar de eliminar la cuenta. Todavia tienes publicaciones pendientes. </p>
              </div>
            </div>
        <?php
          } 
          if (base64_decode($_GET['error']) == 'Error password no es verdadero') { ?>
            <!-- Error al cambiar la clave. -->
            <div id="errorBajaUser" class="col-xs-9 col-md-8 col-xs-offset-2" >
              <div class="alert alert-danger" role="alert">
                <p>Error la contrase&ntilde;a enviada no coincide con su clave. </p>
              </div>
            </div>
          <?php
          }
          if (base64_decode($_GET['error']) == 'Exito al cambiar la password') { ?>
            <!-- Exito al cambiar la clave -->
            <div id="errorBajaUser" class="col-xs-9 col-md-8 col-xs-offset-2" >
              <div class="alert alert-success" role="alert">
                <p>Su contrase&ntilde;a fue cambiada con exito!! </p>
              </div>
            </div>
          <?php
          }
          } // fin isset
        } // fin tipo de usuario ?>

  </div>
</div>

<?php
}else{
?>
  <div class="alert alert-danger" role="alert">
    <strong>Error!</strong>, debe estar logueado para acceder a esta p&aacute;gina. 
    <a href="index.php?op=login" class="alert-link">Ir a login de la pagina</a>.
  </div>
<?php 
}
?>
