<?php

	if (!isset($_GET['op'])){
		$content = 'content/home.php';
	}
	else{
		$op = $_GET['op'];
		switch ($op) {
		case 'registro':
			$content = 'content/registro.php';
			//$title = 'Registro';
			break;
		case 'login':
			$content = 'content/login.php';
			//$title = 'Login';
			break;
		case 'contacto':
			$content = 'content/contacto.php';
			//$title = 'Contacto';
			break;
		case 'cuenta':
			$content = 'content/cuenta.php';
			//$title = 'Cuenta';
			break;
		case 'prod':
			$content = 'content/prod.php';
			break;
		default:
			$content = 'content/home.php';
			//$title = 'home'
			break;
		}
	}	
?>