<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
session_start();

//Head - Lo coloco afuera para que me devuelva los estilos - Chancho :P
include("/../../parsers/admin/head.php");

if (isset($_SESSION['estado']) && $_SESSION['estado'] == "online") { // Para entrar aca hay que iniciar session
	//contenido dinamico
	include("/../../parsers/admin/sidebar.php");  
  	include("/../../handler_content_admin.php");
  	include($content);
	//footer
	include("/../../parsers/admin/footer.php");
}
else
{
?>
	<div class="alert alert-danger" role="alert">
      <strong>Error!</strong>. Ha ocurrido un error al tratar de ingresar a esta pagina.
    </div>
<?php
}
?>
