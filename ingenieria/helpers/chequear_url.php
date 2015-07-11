<?php

function urlExist($url) {
	$arrayUrls = [
	'http://localhost/ingenieria/content/'		  	
	];
	$existe = false;
	foreach($arrayUrls as $val) {
		if ($val == $url) {
			$existe = true;
			break;
		}
	}
	return $existe;
}
?>