<?php
	error_reporting(E_ALL ^ E_NOTICE);
	$site = $_GET['siteMap'];
	switch ($site) {
		case 'categorias':
			$content = '/../content/categorias.php';
			break;
		case 'ganancias':
			$content = '/../content/ganancias.php';
			break;	
		default:
			$content = '/../content/categorias.php';
			break;
	}	
?>