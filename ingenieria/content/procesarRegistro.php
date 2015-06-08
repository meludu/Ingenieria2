<?php

include("/../connect/conexion.php");

$consultaUser = "SELECT email FROM usuarios WHERE email = '".$_POST['email_1']."' ";
$resultadoUser = mysqli_query($link,$consultaUser);
$cantidadUser = mysqli_num_rows($resultadoUser);
if ($cantidadUser == 0) {
  $fechaMod = date('Y-m-d',strtotime($_POST['fechaNacimiento']));
  $tipoUser = "usuario";
  $queryAlta = "INSERT INTO usuarios (tipo, nombre, apellido, sexo, fecha_nac, email, password, imagen, tipoImagen) VALUES ( '".utf8_encode($tipoUser)."', '".utf8_encode($_POST['nombre'])."', '".utf8_encode($_POST['apellido'])."', '".$_POST['sexo']."', '".$fechaMod."', '".$_POST['email_1']."', '".$_POST['clave_1']."', '".null."', '".null."') ";
  mysqli_query($link,$queryAlta);
?>
<script type='text/javascript'>
  alert("El usuario se dió de alta con ÉXITO !");
  window.location='../index.php?op=login';
</script>
<?php
}else{
?>
  <script>
    alert("El usuario ya existe en el sistema, intente con otro !");
    window.location='../index.php?op=registro';
  </script>
<?php
}
mysqli_close($link);
?>