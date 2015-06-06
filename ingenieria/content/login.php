<ol class="breadcrumb">
</ol>
<div class="container">
  <div id="titleLoginSection">
    <center>
      <h2>
          <i class="fa fa-sign-in"></i>  
          Login
      </h2>
    </center>  
  </div>
  <div class="well col-md-6 col-md-offset-3">
      <form class="form-horizontal" role="form" action="connect/comprobar_long.php" method="POST">
        <div class="form-group">
          <label for="inputUserName" class="col-md-4 control-label"><i class="fa fa-user fa-2x"></i></label>
          <div class="col-md-4">
            <input type="email" name="correo" class="form-control" id="input-userName" placeholder="E-mail...">
          </div> <!-- End Form-->
        </div> <!-- End Form-->
        <div class="form-group">
          <label for="inputPassword" class="col-md-4 control-label"><i class="fa fa-unlock-alt fa-2x"></i></label>
          <div class="col-md-4">
            <input type="password" name="clave" class="form-control" id="input-password" placeholder="Password...">
          </div> <!-- End Form-->
        </div> <!-- End Form-->
        <div class="form-group">
          <div class="col-md-offset-4">
            <div class="checkbox">
              <label>
                <input type="checkbox"> Recu&eacute;rdame
              </label>
            </div> <!-- End Form-->
          </div> <!-- End Form-->
        </div> <!-- End Form-->
        <div class="form-group">
          <div class="col-md-offset-4">
            <button type="submit" class="btn btn-success">Iniciar</button>
            <button type="reset" class="btn btn-danger">Cancelar</button>
          </div> <!-- End Div that content buttons-->
        </div> <!-- End Div-->
      </form><!-- End Form-->
  </div>
</div>