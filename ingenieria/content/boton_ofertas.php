<script type="text/javascript">
function justNumbers(e) {
  var keynum = window.event ? window.event.keyCode : e.which;
  if ((keynum == 8) || (keynum == 46))
    return true;
  return /\d/.test(String.fromCharCode(keynum));
} 
</script>

<<<<<<< HEAD
=======

>>>>>>> emmaDev
<button type="button" class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Ofertar</button>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Nueva oferta</h4>
      </div>
      <div class="modal-body">
<<<<<<< HEAD
        <form action="content/boton_ofertas.php" method="POST" data-parsley-validate>
          <div class="form-inline">
              <label class="control-label">Precio:</label>
              <div class="input-group">
                <div class="input-group-addon">$</div>
                <input type="text" class="form-control" data-parsley-trigger="change" data-parsley-type="integer" data-parsley-type="number" data-parsley-min="1" name="precioEntero" placeholder="Valor Entero" required>
                <div class="input-group-addon">.</div>
                <input type="text" class="form-control" data-parsley-trigger="change" data-parsley-type="integer" data-parsley-type="number" data-parsley-maxlength="2" data-parsley-min="0" value="00" name="precioDecimal" placeholder="Escriba de la forma: nn" required>
              </div>
          </div>
          <br>
          <div class="form-group">
            <label for="message-text" class="control-label">Necesidad:</label>
            <textarea class="form-control" data-parsley-trigger="change" onKeyDown="contador(this.form.texto,this.form.remLen,255);" onKeyUp="contador(this.form.texto,this.form.remLen,255);" style="resize:none;" name="texto" rows="4" cols="112" required></textarea>
=======
        <form action="content/boton_ofertas.php" method="POST">
          <div class="form-group">
            <label for="recipient-name" class="control-label">Precio:</label>
            <input class="form-control" name="numero" onkeypress="return justNumbers(event);" type="text" required>
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Necesidad:</label>
            <textarea class="form-control" onKeyDown="contador(this.form.texto,this.form.remLen,255);" onKeyUp="contador(this.form.texto,this.form.remLen,255);" style="resize:none;" name="texto" rows="4" cols="112" required></textarea>
>>>>>>> emmaDev
          </div>
          <input type="text" style="border:none; background-color:transparent;" name="remLen" value="255" disabled readonly>
          <div class="modal-footer">
            <input type="button" class="btn btn-danger" data-dismiss="modal" value="Cerrar">
            <input type="submit" class="btn btn-success" value="Ofertar" name="btn_subir">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
  // Se se manda la oferta
  if (isset($_POST['btn_subir'])) {
<<<<<<< HEAD
    if (!empty($_POST['precioEntero']) && !empty($_POST['precioDecimal']) && !empty($_POST['texto'])) {
      session_start();
      include("../connect/conexion.php");
      
      $precioEntero = $_POST['precioEntero'];
      $precioDecimal = $_POST['precioDecimal'];
      $precioTotal = $precioEntero . '.' . $precioDecimal;

=======
    if (!empty($_POST['numero']) && !empty($_POST['texto'])) {
      session_start();
      include("../connect/conexion.php");
      
>>>>>>> emmaDev
      // Traigo la fecha actual de la BD.
      $queryFechaAct = "SELECT CURDATE()";
      $resFechaAct = mysqli_query($link,$queryFechaAct);
      $fechaAct = mysqli_fetch_array($resFechaAct); 

      // Traigo la hora actual de la BD.  
      $queryHoraAct = "SELECT CURTIME()";
      $resHoraAct = mysqli_query($link,$queryHoraAct);
      $horaAct = mysqli_fetch_array($resHoraAct);

      // Cargo la nueva oferta en la BD
<<<<<<< HEAD
      $queryOferta = "INSERT INTO ofertas (oferta, idUsuario, idProducto, precio, fecha, hora) VALUES ('".$_POST['texto']."', '".$_SESSION['id']."', '".$_SESSION['prod']."', '".$precioTotal."', '".$fechaAct[0]."', '".$horaAct[0]."')";
=======
      $queryOferta = "INSERT INTO ofertas (oferta, idUsuario, idProducto, precio, fecha, hora) VALUES ('".$_POST['texto']."', '".$_SESSION['id']."', '".$_SESSION['prod']."', '".$_POST['numero']."', '".$fechaAct[0]."', '".$horaAct[0]."')";
>>>>>>> emmaDev
      if (mysqli_query($link,$queryOferta)) {
        header("Location: ../index.php?op=publicacion&idP=".$_SESSION['prod']);
      }else{ ?>
        <script type="text/javascript">window.location="index.php"</script>
      <?php
      }

    }else{ ?>
      <script type="text/javascript">window.location="index.php"</script>
    <?php
    }
  }
<<<<<<< HEAD
=======

>>>>>>> emmaDev
?>