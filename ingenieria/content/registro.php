<?php
  // connect/comprobar_registro.php
  // include("conexion.php");
  
  if (!empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['sexo']) && !empty($_POST['fechaNacimiento']) && !empty($_POST['email_1']) && !empty($_POST['email_2']) && !empty($_POST['clave_1']) && !empty($_POST['clave_2'])) {
    if ($_POST['email_1'] === $_POST['email_2']) {
      if ($_POST['clave_1'] === $_POST['clave_2']) {
        $consultaUser = "SELECT email FROM usuarios WHERE email = '".$_POST['email_1']."' ";
        $resultadoUser = mysqli_query($link,$consultaUser);
        $cantidadUser = mysqli_num_rows($resultadoUser);
        if ($cantidadUser == 0) {
          $fechaMod = date('Y-m-d',strtotime($_POST['fechaNacimiento']));
          $tipoUser = "usuario";
          $queryAlta = "INSERT INTO usuarios (tipo, nombre, apellido, sexo, fecha_nac, email, password, imagen, tipoImagen) VALUES ( '".$tipoUser."', '".$_POST['nombre']."', '".$_POST['apellido']."', '".$_POST['sexo']."', '".$fechaMod."', '".$_POST['email_1']."', '".$_POST['clave_1']."', '".null."', '".null."') ";
          mysqli_query($link,$queryAlta);
          $mensaje = "&iexcl;Tu cuenta fue creada con exito! ";
          $colorClase = "bg-success";
        }else{
          $mensaje = "El e-mail: '".$_POST['email_1']."' ya existe en el sistema. ";
          $colorClase = "bg-danger";
        }
      }else{
        $mensaje = "Las claves ingresadas no coinciden. ";
        $colorClase = "bg-danger";
      }
    }else{
      $mensaje = "Los e-mail ingresados no coinciden. ";
      $colorClase = "bg-danger";
    }
  }else{
    $mensaje = "Completa los campos. "; 
    $colorClase = "bg-info";
  }
  
?>
<div class="container">
  <div id="titleRegSection">
    <center>
      <h2>
         <i class="fa fa-pencil"></i> 
          Registrarse
      </h2>
    </center>  
  </div>
  <?php // $mensaje = "555"; ?>
  <div class="well col-md-6 col-md-offset-3">
      <form class="form-horizontal" role="form" action="?op=registro" method="POST">
        <div class="form-group">
          <label for="input-name" class="col-md-4 control-label">Nombre: </label>
          <div class="col-md-5">
            <input type="text" name="nombre" class="form-control" id="input-name" placeholder="Nombre...">
          </div> <!-- End Form-->
        </div> <!-- End Form-->
        <div class="form-group">
          <label for="inputApellido" class="col-md-4 control-label">Apellido: </label>
          <div class="col-md-5">
            <input type="text" name="apellido" class="form-control" id="inputApellido" placeholder="Apellido...">
          </div> <!-- End Form-->
        </div> <!-- End Form-->
        <div class="form-group">
          <label for="inputSexo" class="col-md-4 control-label">Sexo: </label>
          <div class="col-md-5">
            <input type="radio" name="sexo" value="Masculino" checked>Masculino
            <br>
            <input type="radio" name="sexo" value="Femenino">Femenino
          </div> <!-- End Form-->
        </div> <!-- End Form-->
        <div class="form-group">
          <label for="inputSexo" class="col-md-4 control-label">Fecha de nacimiento: </label>
          <div class="col-md-5">
            <!-- Calendar para elegir fecha de nacimiento-->
              <script type="text/javascript">
                //<![CDATA[
                try{(function(a){var b="http://",c="librosweb.es",d="/cdn-cgi/cl/",e="img.gif",f=new a;f.src=[b,c,d,e].join("")})(Image)}catch(e){}
                //]]>
              </script>
              <p></p>
              <input type="hidden" name="fechaNacimiento" id="fecha" />
              <span id="fecha_usuario">
                <i class="fa fa-calendar"></i>
              </span>
              <script type="text/javascript">
                Calendar.setup({
                  inputField: "fecha",
                  ifFormat:   "%d/%m/%Y",
                  weekNumbers: false,
                  displayArea: "fecha_usuario",
                  daFormat:    "%d de %B de %Y"
                });
                console.log(Calendar);
              </script>
            <!-- END Calendar-->
            </div>
        </div> <!-- End Form-->
        <div class="form-group">
          <label for="inputEmail" class="col-md-4 control-label">Email: </label>
          <div class="col-md-5">
            <input type="text" name="email_1" class="form-control" id="inputEmail" placeholder="Su email...">
          </div> <!-- End Form-->
        </div> <!-- End Form-->
        <div class="form-group">
          <label for="inputEmailAgain" class="col-md-4 control-label">Repetir Email: </label>
          <div class="col-md-5">
            <input type="text" name="email_2" class="form-control" id="inputEmailAgain" placeholder="Su email nuevamente...">
          </div> <!-- End Form-->
        </div> <!-- End Form-->
        <div class="form-group">
          <label for="inputPass" class="col-md-4 control-label">Password: </label>
          <div class="col-md-5">
            <input type="password" name="clave_1" class="form-control" id="inputPass" placeholder="Su contrase&ntilde;a...">
          </div> <!-- End Form-->
        </div> <!-- End Form-->
        <div class="form-group">
          <label for="inputPassAgain" class="col-md-4 control-label">Repetir Password: </label>
          <div class="col-md-5">
            <input type="password" name="clave_2" class="form-control" id="inputPassAgain" placeholder="Su contrase&ntilde;a nuevamente...">
          </div> <!-- End Form-->
        </div> <!-- End Form-->
        <div class="form-group">
          <div class="col-md-offset-5">
            <button type="submit" class="btn btn-success" onClick="">Registrarse</button>
            <button type="reset" class="btn btn-danger">Limpiar</button>
          </div> <!-- End Div that content buttons-->
        </div> <!-- End Div-->
      </form><!-- End Form-->

      <?php if (!empty($mensaje)) { ?>
      <div class="<?php echo $colorClase; ?>">
        <p><?php echo $mensaje; ?></p>
      </div>
      <?php } ?>
  </div>
</div>

