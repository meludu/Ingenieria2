<button type="button" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Borrar</button>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Borrando publicaci&oacute;n</h4>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
          <div class="form-group">
            <p>¿Estas seguro en querer borrar esta publicaci&oacute;n?</p>
          </div>
          <input name="idPro" type="hidden" value="<?php echo $_GET['idP']; ?>">
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="No">
            <input type="submit" class="btn btn-danger" name="btn_borrar" value="Si">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php 
  if (isset($_POST['btn_borrar'])) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    session_start();
    //include("../connect/conexion.php");

    // Veo que la publicacion no tenga preguntas, ni ofertas.
    $queryCantPre = "SELECT COUNT(*) FROM preguntas p INNER JOIN preguntas_productos pp ON(p.idPregunta = pp.idPregunta) INNER JOIN productos pro ON(pp.idProducto = pro.idProducto) WHERE pro.idProducto = '".$_POST['idPro']."' ";
    $resCantPre = mysqli_query($link,$queryCantPre);
    $tuplaCantPre = mysqli_fetch_array($resCantPre);
    $queryCantOfer = "SELECT COUNT(*) FROM ofertas WHERE idProducto = '".$_POST['idPro']."' ";
    $resCantOfer = mysqli_query($link,$queryCantOfer);
    $tuplaCantOfer = mysqli_fetch_array($resCantOfer);

    if ($tuplaCantPre[0] == 0 && $tuplaCantOfer[0] == 0) {    // Si las preg y ofer son 0 puedo borrar.
      $oldEstado = 0;
      $newEstado = 1;
      $queryBajaPro = "UPDATE productos SET estado = '$newEstado' WHERE idProducto = '".$_POST['idPro']."' AND estado = '$oldEstado' ";
      mysqli_query($link,$queryBajaPro); ?>
      <script type="text/javascript">
        window.location="index.php";
      </script>
      <?php
    }else{ 
      echo "<br>";
      echo '<div class="alert alert-danger" role="alert"><p>La publicacion tiene preguntas u ofertas; no es posible eliminarla. </p></div>';
    }
  }/*
  if (isset($_POST['btn_borrar'])) {
    session_start();
    include("../connect/conexion.php");

    // Veo que la publicacion no tenga preguntas, ni ofertas.
    $queryCantPre = "SELECT COUNT(*) FROM preguntas p INNER JOIN preguntas_productos pp ON(p.idPregunta = pp.idPregunta) INNER JOIN productos pro ON(pp.idProducto = pro.idProducto) WHERE pro.idProducto = '".$_POST['idPro']."' ";
    $resCantPre = mysqli_query($link,$queryCantPre);
    $tuplaCantPre = mysqli_fetch_array($resCantPre);
    $queryCantOfer = "SELECT COUNT(*) FROM ofertas WHERE idProducto = '".$_POST['idPro']."' ";
    $resCantOfer = mysqli_query($link,$queryCantOfer);
    $tuplaCantOfer = mysqli_fetch_array($resCantOfer);

    if ($tuplaCantPre[0] == 0 && $tuplaCantOfer[0] == 0) {    // Si las preg y ofer son 0 puedo borrar.
      $oldEstado = 0;
      $newEstado = 1;
      $queryBajaPro = "UPDATE productos SET estado = '$newEstado' WHERE idProducto = '".$_POST['idPro']."' AND estado = '$oldEstado' ";
      mysqli_query($link,$queryBajaPro);
      header("Location: ../index.php");
<<<<<<< HEAD

=======
>>>>>>> mis ofertas
    }else{ ?>
      <script type="text/javascript">
        alert("La publicacion tiene preguntas u ofertas; no es posible eliminarla. ");
        history.go(-1);
      </script>
    <?php
    }
  } */
?>