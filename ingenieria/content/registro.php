<div class="container">
  <div id="titleRegSection">
    <center>
      <h2>
         <i class="fa fa-pencil"></i> 
          Registrarse
      </h2>
    </center>  
  </div>
  <div class="well col-md-6 col-md-offset-3">
  <form class="form-horizontal" role="form" action="content/procesarRegistro.php" method="post" data-parsley-validate >
    <div class="form-group">
      <label for="input-name" class="col-md-4 control-label">Nombre <i>*</i> :</label>
      <div class="col-md-5">
        <input type="text" name="nombre" class="form-control" id="input-name" placeholder="Su Nombre" required />
      </div>  
    </div><!-- End Form-->
    <div class="form-group">
      <label for="input-apellido" class="col-md-4 control-label">Apellido <i>*</i> :</label>
      <div class="col-md-5">
        <input type="text" name="apellido" class="form-control" id="input-apellido" placeholder="Su Apellido" required />
      </div>  
    </div><!-- End Form-->
    <div class="form-group">
      <label for="inputSexo" class="col-md-4 control-label">Sexo <i>*</i>:</label>
      <div class="col-md-5">
        <input type="radio" name="sexo" id="genderM" value="Masculino" required />Masculino
        <br>
        <input type="radio" name="sexo" id="genderF" value="Femenino" />Femenino
      </div>
    </div><!-- End form -->
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
        <input type="hidden" name="fechaNacimiento" id="fecha" data-parsley-validate-if-empty />
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
      <label for="inputEmail" class="col-md-4 control-label">Email <i>*</i> :</label>  
      <div class="col-md-5">
        <input type="email" name="email_1" id="inputEmail" class="form-control" data-parsley-trigger="change" placeholder="Su Email" required />
      </div>
    </div><!-- End form -->
    <div class="form-group">
      <label for="inputEmailAgain" class="col-md-4 control-label">Repetir Email <i>*</i> :</label>  
      <div class="col-md-5">
        <input type="email" name="email_2" id="inputEmailAgain" class="form-control" data-parsley-equalto="#inputEmail" data-parsley-trigger="change" placeholder="Su Email nuevamente" required />
      </div>
    </div><!-- End form -->
    <div class="form-group">
      <label for="inputPass" class="col-md-4 control-label">Password: </label>
      <div class="col-md-5">
        <input type="password" data-parsley-minlength="8" name="clave_1" class="form-control" id="inputPass" data-parsley-trigger="change" placeholder="Su contrase&ntilde;a">
      </div> <!-- End Form-->
    </div> <!-- End Form-->
    <div class="form-group">
      <label for="inputPassAgain" class="col-md-4 control-label">Repetir Password: </label>
      <div class="col-md-5">
        <input type="password" data-parsley-minlength="8" data-parsley-equalto="#inputPass" data-parsley-trigger="change" name="clave_1" class="form-control" id="inputPassAgain" placeholder="Su contrase&ntilde;a nuevamente">
      </div> <!-- End Form-->
    </div> <!-- End Form-->
    <!-- regular select input. Nothing more to add. -->
    <div class="form-group">
      <div class="col-md-offset-4">
        <button type="submit" class="btn btn-success">Registrarse</button>
        <button type="reset" class="btn btn-danger">Limpiar</button>
      </div>
    </div>
  </form>
</div>