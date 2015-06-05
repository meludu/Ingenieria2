<?php 
	session_start();
	unset($_SESSION['estado']);
	unset($_SESSION['user']);
	unset($_SESSION['start']);
	session_destroy();
	header("Location: ../index.php");
	exit;
?>