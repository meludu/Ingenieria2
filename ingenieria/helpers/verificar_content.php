<?php

//verifica si en la url existe /content/
function existe_content_en_url($url) {
	$cadena_de_texto = $url;
	$cadena_buscada   = '/content/';
	$posicion_coincidencia = strpos($cadena_de_texto, $cadena_buscada);
	 
	if ($posicion_coincidencia === false) {
		$existe = false; 
		//carga css y scripts sin /ingenieria adelante
	} 
	else {
		$existe = true;
        //carga css y scripts de head y footer con /ingenieria adelante
	}
	return $existe;
}

?>