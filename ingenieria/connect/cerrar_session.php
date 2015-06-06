<?php 
	session_start();
	unset($_SESSION['estado']);
	unset($_SESSION['id']);
	unset($_SESSION['user']);
	unset($_SESSION['start']);
	unset($_SESSION['expire']);
	unset($_SESSION['tieneFoto']);
	session_destroy();
	header("Location: ../index.php");
	exit;
?>