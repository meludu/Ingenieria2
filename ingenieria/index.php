<?php
	include("/parsers/head.php");
	include("/parsers/header_user.php");
	include("handler_content.php");
	if (($content == "content/home.php") || ($content == "content/prod.php")) {
		include("/parsers/actualizar_bd.php"); // Actualiza la bd constantemente.
	}
	include($content);
	include("/parsers/footer.php");
?>