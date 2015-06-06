<?php
	error_reporting(E_ALL ^ E_NOTICE);
	$site = $_GET['siteMap'];
	switch ($site) {
		case 'categorias':
			$content = '/../../content/admin/categorias.php';
			break;
		/*case 'subcategorias':
			$content = '/../../content/admin/subcategorias.php';
			break;*/
		default:
			$content = '/../../content/admin/categorias.php';
			break;
	}	
?>