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
  // Selecciono todas las categorias para mostrarselas al usuario. 
  $queryCat = "SELECT * FROM categorias ORDER BY nombre_cat";
  $resCat = mysqli_query($link,$queryCat);
?>
<div class="container">
  <div id="titleRegSection">
    <center>
      <h2>
         <i class="fa fa-gears"></i> 
          Publicando producto
      </h2>
    </center>  
  </div>
  <div class="well col-md-12">
  <form class="form-horizontal" role="form" enctype="multipart/form-data" action="?op=publicar" method="post"  data-parsley-validate >

    <div class="form-group">
      <label for="input-nombre" class="col-md-4 control-label">Titulo <i>*</i> :</label>
      <div class="col-md-5">
        <input type="text" name="titulo" class="form-control" id="input-name" maxlength="20" placeholder="Titulo... " required />
      </div>  
    </div><!-- End Form-->

    <div class="form-group">
      <label for="input-categoria" class="col-md-4 control-label">Categoria <i>*</i> :</label>
      <div class="col-md-5">
        <select name="nomCat" class="form-control"  style="width: 200px;">
          <?php while ($tuplaCat = mysqli_fetch_array($resCat)) { // Aca muestro las categorias. ?>
            <option value="<?php echo $tuplaCat['idCategoria']; ?>"><?php echo $tuplaCat['nombre_cat']; ?></option>
          <?php } // fin while ?>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label for="input-descCorta" class="col-md-4 control-label">Descripcion corta <i>*</i> :</label>
      <div class="col-md-5">
        <textarea class="form-control" name="descCorta" style="resize:none;" rows="3" cols="100" maxlength="150" onKeyDown="contador(this.form.descCorta,this.form.remLen1,150);" onKeyUp="contador(this.form.descCorta,this.form.remLen1,150);" required></textarea>
         <input type="text" style="border:none; background-color:transparent;" name="remLen1" value="150" disabled readonly>
      </div>  
    </div><!-- End Form-->

    <div class="form-group">
      <label for="imagen-portada" class="col-md-4 control-label">Portada <i>*</i> :</label>
      <div class="col-md-5">
        <input type="file" name="imgPortada" id="exampleInputFile" required>
        <p class="help-block">Esta imagen es la que se va a mostrar al inicio.</p>
      </div>
    </div>

    <div class="form-group">
      <label for="input-nombre" class="col-md-4 control-label">D&iacute;as publicado <i>*</i> :</label>
      <div class="col-md-5">
        <input  style="width: 100px;" type="number" name="cantDias" class="form-control" id="input-name" value="15" min="15" max="30" onkeypress="return soloNumeros(event);" placeholder="D&iacute;as... " required />
      </div>  
    </div><!-- End Form-->

    <div class="form-group">
      <label for="input-descLarga" class="col-md-4 control-label">Descripcion Larga <i>*</i> :</label>
      <div class="col-md-5">
        <textarea class="form-control" name="descLarga" style="resize:none;" rows="7" cols="100" maxlength="400" onKeyDown="contador(this.form.descLarga,this.form.remLen2,400);" onKeyUp="contador(this.form.descLarga,this.form.remLen2,400);" required></textarea>
        <input type="text" style="border:none; background-color:transparent;" name="remLen2" value="400" disabled readonly>
      </div>  
    </div>
    <hr>
    <div class="form-group">
      <label for="imagen-portada" class="col-md-4 control-label">Imagenes :</label>
      <div class="col-md-5">
        <input type="file" name="img1" id="exampleInputFile">
        <input type="file" name="img2" id="exampleInputFile">
        <input type="file" name="img3" id="exampleInputFile">
        <p class="help-block">Estas imagenes no son obligatorias. </p>
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-offset-4">
        <button name="btn_publicar" type="submit" class="btn btn-success">Publicar</button>
        <button type="reset" class="btn btn-danger">Limpiar</button>
      </div>
    </div>
  </form>
</div>

<?php
  // Se carga la nueva publicacion en la BD si no hay ningun problema.

  if (isset($_POST['btn_publicar'])) {
    if (!empty($_POST['titulo']) && !empty($_POST['nomCat']) && !empty($_POST['descCorta']) && !empty($_FILES['imgPortada']) && !empty($_POST['cantDias']) && !empty($_POST['descLarga'])) {
      
      // Traigo la fecha actual de la BD.
      $queryFechaAct = "SELECT CURDATE()";
      $resFechaAct = mysqli_query($link,$queryFechaAct);
      $fechaAct = mysqli_fetch_array($resFechaAct);  

      // El dia que finaliza la subasta: 
      $dias = $_POST['cantDias'];
      $fec_fin= date("Y-m-d", strtotime("$fecha + $dias days"));

      if (isset($_FILES["imgPortada"]) || $_FILES["imgPortada"]["error"] > 0){
        //ahora vamos a verificar si el tipo de archivo es un tipo de imagen permitido.
        //y que el tamano del archivo no exceda los 16MB
        $permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
        $limite_kb = 16384;
        if (in_array($_FILES['imgPortada']['type'], $permitidos) && $_FILES['imgPortada']['size'] <= $limite_kb * 1024){

          //este es el archivo temporal
          $imagen_temporal  = $_FILES['imgPortada']['tmp_name'];
          //este es el tipo de archivo
          $tipo = $_FILES['imgPortada']['type'];
          //leer el archivo temporal en binario
          $fp = fopen($imagen_temporal, 'r+b');
          $data = fread($fp, filesize($imagen_temporal));
          fclose($fp);
          //escapar los caracteres
          $data = mysql_escape_string($data);

          $vis = 0; // Inicializo las visitas en 0.
          $ganador = 0;  // Inicializo ganador en null (modifique la BD).
          $fechaMod = date('Y-m-d',strtotime($fec_fin));

          $queryAltaPro = "INSERT INTO productos (nombre, descripcionCorta, descripcionLarga, portada, tipoPortada, visitas, idCategoria, fecha_ini, fecha_fin, idUsuario, idGanador) VALUES ('".$_POST['titulo']."', '".$_POST['descCorta']."', '".$_POST['descLarga']."', '".$data."', '".$tipo."', '".$vis."', '".$_POST['nomCat']."', '".$fechaAct[0]."', '".$fechaMod."', '".$_SESSION['id']."', '".$ganador."') ";
          $resultado = mysqli_query($link,$queryAltaPro);

            //echo $queryAltaPro;

            $lastID = mysqli_insert_id($link);

            if ($_FILES['img1']['error'] != 4) {  // Si es igual a 4 quiere decir que no se envio nada
              echo "aca 1 ??";
              $ruta = 'imagenes';
              $tmpname = $_FILES['img1']['tmp_name'];
              $name = $_FILES['img1']['name'];
              move_uploaded_file($tmpname,"$ruta/$name");
              $completo = "$ruta/$name";
              $queryAltaImg = "INSERT INTO imagenes (url, idProducto) VALUES ('".$completo."', '".$lastID."')";
              mysqli_query($link,$queryAltaImg);
            }
            if ($_FILES['img2']['error'] != 4) {
              echo "aca 2 ???";
              $ruta = 'imagenes';
              $tmpname = $_FILES['img2']['tmp_name'];
              $name = $_FILES['img2']['name'];
              move_uploaded_file($tmpname,"$ruta/$name");
              $completo = "$ruta/$name";
              $queryAltaImg = "INSERT INTO imagenes (url, idProducto) VALUES ('".$completo."', '".$lastID."')";
              mysqli_query($link,$queryAltaImg);
            }
            /*if (!empty($_FILES['img3'])) {
              subirImagen($_FILES['img3'],$lastID);
            }*/

        }else{
          echo "Imagen demasiado grande o el tipo de imagen no esta permitido. ";
        }
      }

    } // fin del if que comprueba si nada es vacio.
  } // fin primer if
?>