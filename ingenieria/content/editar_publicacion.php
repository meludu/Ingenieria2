<?php
  if (isset($_SESSION['estado']) && $_SESSION['estado'] == "online" && $_SESSION['tipo'] =="usuario") {
?>
<script type="text/javascript">
  function soloNumeros(e) {
        var keynum = window.event ? window.event.keyCode : e.which;
        if (keynum < 30) {
        if ((keynum == 8) || (keynum == 46))
          return true;
        }
        return /\d/.test(String.fromCharCode(keynum));
  }
  function contador (campo, cuentacampo, limite) { 
        if (campo.value.length > limite) campo.value = campo.value.substring(0, limite); 
        else cuentacampo.value = limite - campo.value.length; 
   } 
</script>


<?php
  // Veo que la publicacion no tenga preguntas, ni ofertas.
  $queryCantPre = "SELECT COUNT(*) FROM preguntas p INNER JOIN preguntas_productos pp ON(p.idPregunta = pp.idPregunta) INNER JOIN productos pro ON(pp.idProducto = pro.idProducto) WHERE pro.idProducto = '".$_POST['idPro']."' ";
  $resCantPre = mysqli_query($link,$queryCantPre);
  $tuplaCantPre = mysqli_fetch_array($resCantPre);

  $queryCantOfer = "SELECT COUNT(*) FROM ofertas WHERE idProducto = '".$_POST['idPro']."' ";
  $resCantOfer = mysqli_query($link,$queryCantOfer);

  $tuplaCantOfer = mysqli_fetch_array($resCantOfer);
  if ($tuplaCantPre[0] == 0 && $tuplaCantOfer[0] == 0) {    // Si las preg y ofer son 0 puedo modificar.
    // Selecciono todas las categorias para mostrarselas al usuario. 
    $queryCat = "SELECT * FROM categorias ORDER BY nombre_cat";
    $resCat = mysqli_query($link,$queryCat);
   
    // Traigo de la BD la publicacion a modificar. 
    $queryPubMod = "SELECT p.nombre AS nom, p.descripcionCorta AS descCor, p.descripcionLarga AS descLar, p.fecha_ini AS fi, p.fecha_fin AS ff, p.idCategoria AS idC, c.nombre_cat AS nomC FROM productos p INNER JOIN categorias c ON(p.idCategoria = c.idCategoria) WHERE p.idProducto = '".$_POST['idPro']."' ";
    $resPubMod = mysqli_query($link,$queryPubMod);
    $tuplaPubMod = mysqli_fetch_array($resPubMod);
?>
<div class="container">
  <div id="titleRegSection">
    <center>
      <h2>
         <i class="fa fa-gears"></i> 
          Modificando producto
      </h2>
    </center>  
  </div>
  <div class="well col-md-12">
  <form class="form-horizontal" role="form" action="?op=editarPubl" method="post" data-parsley-validate >
    <div class="form-group">
      <label for="input-nombre" class="col-md-4 control-label">Titulo <i>*</i> :</label>
      <div class="col-md-5">
        <input type="text" name="titulo" class="form-control" id="input-name" data-parsley-trigger="change" maxlength="20" value="<?php echo $tuplaPubMod['nom']; ?>" placeholder="Titulo... " required />
      </div>  
    </div><!-- End Form-->

    <div class="form-group">
      <label for="input-categoria" class="col-md-4 control-label">Categoria <i>*</i> :</label>
      <div class="col-md-5">
        <select name="nomCat" class="form-control"  style="width: 200px;">
          <?php while ($tuplaCat = mysqli_fetch_array($resCat)) { // Aca muestro las categorias. $tup
            if ($tuplaCat['idCategoria'] == $tuplaPubMod['idC']) { ?>
              <option value="<?php echo $tuplaPubMod['idC']; ?>" selected="selected"><?php echo $tuplaPubMod['nomC']; ?></option>
            <?php
            }else{ ?>
            <option value="<?php echo $tuplaCat['idCategoria']; ?>"><?php echo $tuplaCat['nombre_cat']; ?></option>
            <?php } ?>
          <?php } // fin while ?>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label for="input-descCorta" class="col-md-4 control-label">Descripcion corta <i>*</i> :</label>
      <div class="col-md-5">
        <textarea class="form-control" name="descCorta" data-parsley-trigger="change" style="resize:none;" rows="3" cols="100" maxlength="150" onKeyDown="contador(this.form.descCorta,this.form.remLen1,150);" onKeyUp="contador(this.form.descCorta,this.form.remLen1,150);" required><?php echo $tuplaPubMod['descCor']; ?></textarea>
         <input type="text" style="border:none; background-color:transparent;" name="remLen1" value="150" disabled readonly>
      </div>  
    </div><!-- End Form-->

    <?php // acomodo la fecha para verla en cantdad de dias.
      $t = (strtotime($tuplaPubMod['ff']) - strtotime($tuplaPubMod['fi'])) / 60 / 60 / 24;
    ?>
    <div class="form-group">
      <label for="input-nombre" class="col-md-4 control-label">D&iacute;as publicado <i>*</i> :</label>
      <div class="col-md-5">
        <input  style="width: 100px;" type="number" name="cantDias" data-parsley-trigger="change" data-parsley-type="number" data-parsley-range="[10,15]" class="form-control" id="input-name" min="15" max="30" onkeypress="return soloNumeros(event);" placeholder="D&iacute;as... " value="<?php echo $t; ?>" required />
      </div>  
    </div><!-- End Form-->

    <div class="form-group">
      <label for="input-descLarga" class="col-md-4 control-label">Descripcion Larga <i>*</i> :</label>
      <div class="col-md-5">
        <textarea class="form-control" name="descLarga" style="resize:none;" rows="7" cols="100" maxlength="400" onKeyDown="contador(this.form.descLarga,this.form.remLen2,400);" onKeyUp="contador(this.form.descLarga,this.form.remLen2,400);" required><?php echo $tuplaPubMod['descLar']; ?></textarea>
        <input type="text" style="border:none; background-color:transparent;" name="remLen2" value="400" disabled readonly>
      </div>  
    </div>

    <input name="idPro" type="hidden" value="<?php echo $_POST['idPro'];  ?>">
    <input name="fi" type="hidden" value="<?php echo $tuplaPubMod['fi']; ?>">

    <div class="form-group">
      <div class="col-md-offset-5">
        <button name="btn_modificar" type="submit" class="btn btn-success" >Modificar</button>
        <button type="reset" class="btn btn-danger">Limpiar</button>
      </div>
    </div>
  </form>
</div>
</div>

<?php
  }else{
  ?>
  <script type="text/javascript">
      window.onload = function() { document.formEdit.submit(); }
      //window.location="index.php?op=publicacion&idP="+<?php echo $_POST['idPro']; ?>;
    </script>
    <form id="formEdit" name="formEdit" action="index.php?op=publicacion&idP=<?php echo $_POST['idPro']; ?>" method="POST">
      <input type="hidden" name="errorEdit" value="error">
    </form>
    
  <?php
  }
?>


<?php
  if (isset($_POST['btn_modificar'])) { 
      // El dia que finaliza la subasta: 
      $dias = $_POST['cantDias'];
      $fec_fin= date("Y-m-d", strtotime($_POST['fi']."+ $dias days"));
    $queryAct = "UPDATE productos SET nombre = '".$_POST['titulo']."', descripcionCorta = '".$_POST['descCorta']."', descripcionLarga = '".$_POST['descLarga']."', idCategoria = '".$_POST['nomCat']."', fecha_fin = '".$fec_fin."' WHERE idProducto = '".$_POST['idPro']."' ";
    if (mysqli_query($link,$queryAct)) { ?>
      <script type="text/javascript">
        // alert("Se modifico la publicacion!! ");
        window.location="index.php?op=publicacion&idP="+<?php echo $_POST['idPro']; ?>; 
      </script>
    <?php
    }else{
      echo "Error: ".mysqli_error();
    }
  }
?>

<?php
}else{  // if de la comprobacion de usuario. ?>
  <script type="text/javascript">window.location="index.php"</script>
<?php
}
?>