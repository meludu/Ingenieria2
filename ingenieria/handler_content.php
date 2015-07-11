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
		case 'publicacion':
			$content = 'content/publicacion.php';
			break;
		case 'publicar':
			$content = 'content/publicar.php';
			break;
		case 'modNoti':
			$content = 'content/modificarNoti.php';
			break;
		case 'allNoti':
			$content = 'content/todas_notificaciones.php';
			break;
		case 'misProds':
			$content = 'content/mis_productos.php';
			break;
		case 'subastas': //Si el usuario es admin - desp pasarlo a handler admin
			$content = 'content/subastas.php';
			break;
		case 'editarPubl':
			$content = 'content/editarPublicacion.php';
			break;
		default:
			$content = 'content/home.php';
			//$title = 'home'
			break;
		}
	}	
?>