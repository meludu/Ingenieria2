<script type="text/javascript">
function justNumbers(e) {
  var keynum = window.event ? window.event.keyCode : e.which;
  if ((keynum == 8) || (keynum == 46))
    return true;
  return /\d/.test(String.fromCharCode(keynum));
} 
</script>

<button type="button" class="btn btn-warning btn-lg btn-block" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Modificar ofertar</button>
<?php
	$queryOferta = "SELECT * FROM ofertas WHERE idOferta = '".$_SESSION['oferta']."' ";
	$resOferta = mysqli_query($link,$queryOferta);
	$tuplaOferta = mysqli_fetch_array($resOferta);
?>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Modificando oferta</h4>
      </div>
      <div class="modal-body">
        <form action="content/modificar_oferta.php" method="POST">
          <div class="form-group">
            <label for="recipient-name" class="control-label">Precio:</label>
            <input class="form-control" name="numero" onkeypress="return justNumbers(event);" type="text" value="<?php echo $tuplaOferta['precio']; ?>" required>
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Necesidad:</label>
            <textarea class="form-control" onKeyDown="contador(this.form.texto,this.form.remLen,255);" onKeyUp="contador(this.form.texto,this.form.remLen,255);" style="resize:none;" name="texto" rows="4" cols="112" required><?php echo $tuplaOferta['oferta']; ?></textarea>
          </div>
          <input type="text" style="border:none; background-color:transparent;" name="remLen" value="255" disabled readonly>
          <div class="modal-footer">
            <input type="button" class="btn btn-danger" data-dismiss="modal" value="Cerrar">
            <input type="submit" class="btn btn-warning" value="Modificar" name="btn_modificar">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
	// Modifico la oferta
	if (isset($_POST['btn_modificar'])) {
		include("../connect/conexion.php");
		session_start();
		if (!empty($_POST['numero']) && !empty($_POST['texto'])) {
			$queryModOfe = "UPDATE ofertas SET oferta = '".$_POST['texto']."', precio = '".$_POST['numero']."' WHERE idOferta = '".$_SESSION['oferta']."' ";
			mysqli_query($link,$queryModOfe);
			header("Location: ../index.php?op=publicacion&idP=".$_SESSION['prod']);
		}else{ ?>
      		<script type="text/javascript">window.location="index.php"</script>
    	<?php
		}
	}
?>