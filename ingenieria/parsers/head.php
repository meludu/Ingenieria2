<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Subasta</title>

    <?php
    include_once('/../helpers/verificar_content.php');
    if(existe_content_en_url('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) == 'no existe'){
        $concat = '/ingenieria2/ingenieria/';
    }
    else
    {
        $concat = '';
    }
    ?>
    <link rel="icon" type="image/png" href="<?php echo $concat;?>public/img/logo.png" 
    />

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo $concat;?>public/css/bootstrap.css" rel="stylesheet">
    <!-- load font-awesome-->
    <link href="<?php echo $concat;?>public/css/font-awesome.css" rel="stylesheet">    
    <!-- Custom CSS -->
    <link href="<?php echo $concat;?>public/css/homepage.css" rel="stylesheet">
    
    <link href="<?php echo $concat;?>/public/css/admin.css" rel="stylesheet">
    
    <link href='http://fonts.googleapis.com/css?family=Amaranth' rel='stylesheet' type='text/css'>

    <link href="<?php echo $concat;?>public/css/calendar.css" rel="stylesheet">
    
    <link rel="stylesheet" href="<?php echo $concat;?>public/css/parsley.css">    
    <!-- scripts para el calendario-->
    <script src="<?php echo $concat;?>public/js/calendar.js"></script>
    <script src="<?php echo $concat;?>public/js/calendar-es.js"></script>
    <script src="<?php echo $concat;?>public/js/calendar-setup.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script language="JavaScript" src="<?php echo $concat;?>public/js/jquery.js"></script>
    <script language="JavaScript" src="<?php echo $concat;?>public/js/jquery.watermarkinput.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){

    $(".busca").keyup(function() //se crea la funcioin keyup
    {
    var texto = $(this).val();//se recupera el valor de la caja de texto y se guarda en la variable texto
    var dataString = 'palabra='+ texto;//se guarda en una variable nueva para posteriormente pasarla a search.php
    if(texto=='')//si no tiene ningun valor la caja de texto no realiza ninguna accion y deja de mostrar lo que se buscó.
    {
         $("#display").hide(); 
    }
    else
    {
    $.ajax({//metodo ajax
    type: "POST",//aqui puede  ser get o post
    url: "parsers/search.php",//la url adonde se va a mandar la cadena a buscar
    data: dataString,
    cache:false,
    success: function(html)//funcion que se activa al recibir un dato
    {
    $("#display").html(html).show();// funcion jquery que muestra el div con identificador display, como formato html, tambien puede ser .text
    //$("#display").prepend($(html).fadeIn(1200)); 
    }
    });
    }return false;    
    });
    });
    jQuery(function($){//funcion jquery que muestra el mensaje "Buscar producto.." en la caja de texto
       $("#caja_busqueda").Watermark("Buscar producto..");
       });
    </script>

    <meta http-equiv="conten-type" content="text/html; charset=UTF-8" />
    
</head>