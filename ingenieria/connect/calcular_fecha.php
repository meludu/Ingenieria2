<?php

function interval_date($init,$finish) {
    //formateamos las fechas a segundos tipo 1374998435
    // echo strtotime($finish)." - <br>".strtotime($init);
    $diferencia = strtotime($finish) - strtotime($init);
    // echo "<br>diferencia: $diferencia <br>";
 
    //comprobamos el tiempo que ha pasado en segundos entre las dos fechas
    //floor devuelve el número entero anterior, si es 5.7 devuelve 5
   /* if($diferencia < 60){
        $tiempo = "Termina en " . floor($diferencia) . " segundos";
    }else if($diferencia > 60 && $diferencia < 3600){
        $tiempo = "Termina en " . floor($diferencia/60) . " minutos'";
    }else if($diferencia > 3600 && $diferencia <= 86400){
        $tiempo = "Termina en " . floor($diferencia/3600) . " horas";   // cambiar mensaje a hoy?
    }else if($diferencia > 86400 && $diferencia < 2592000){
        $tiempo = "Termina en " . floor($diferencia/86400) . " d&iacute;as";
    }else if($diferencia > 2592000 && $diferencia < 31104000){
        $tiempo = "Termina en " . floor($diferencia/2592000) . " meses";
    }else if($diferencia > 31104000){
        $tiempo = "Termina en " . floor($diferencia/31104000) . " años";
    }else{
        $tiempo = "Error";
    }

    return $tiempo;*/

    if ($diferencia >= 0) {
        if ($diferencia < 60) {
            $tiempo = "Termina hoy!";
        }else if($diferencia > 3600 && $diferencia < 86400){
            $tiempo = "Termina hoy!";
        }else if($diferencia >= 86400 && $diferencia < 2592000){
            $tiempo = "Termina en " . floor($diferencia/86400) . " d&iacute;as";
        }else{
            $tiempo = "Publicaci&oacute;n finalizada.";
        } 
    }else{
        $tiempo = "Publicaci&oacute;n finalizada.";
    }
    return $tiempo;
}

?>