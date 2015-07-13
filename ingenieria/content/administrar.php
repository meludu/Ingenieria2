<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
session_start();

//Head - Lo coloco afuera para que me devuelva los estilos - Chancho :P
include_once("/../parsers/head.php");

<<<<<<< HEAD
if (isset($_SESSION['estado']) && $_SESSION['estado'] == "online") { // Para entrar aca hay que iniciar session
=======
if (isset($_SESSION['estado']) && $_SESSION['estado'] == "online" && $_SESSION['tipo']=="admin") { // Para entrar aca hay que iniciar session
>>>>>>> emmaDev
	//contenido dinamico
	include_once("/../parsers/sidebar.php");
    include_once("/../handler_content_admin.php");
  	include_once($content);
	//footer
	include_once("/../parsers/footer.php");
  	
}
else
{
<<<<<<< HEAD
?>
<div class="alert alert-danger" role="alert">
    <strong>Error!</strong>, debe estar logueado para acceder a esta p&aacute;gina. 
=======

?>
<div class="alert alert-danger" role="alert">
    <strong>Error!</strong>, debe estar logueado  como administrador para acceder a esta p&aacute;gina. 
>>>>>>> emmaDev
	<a href="../index.php?op=login" class="alert-link">Ir a login de la pagina</a>.
</div>
<?php
}
?>
