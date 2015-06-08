<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Subasta</title>
    <link rel="icon" type="image/png" href="../public/img/logo.png" />

    <!-- Bootstrap Core CSS -->
    <link href="../public/css/bootstrap.css" rel="stylesheet">
    <!-- load font-awesome-->
    <link href="../public/css/font-awesome.css" rel="stylesheet">    
    <!-- Custom CSS -->
    <link href="../public/css/homepage.css" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Amaranth' rel='stylesheet' type='text/css'>

    <link href="../public/css/calendar.css" rel="stylesheet">
    
    <!-- scripts para el calendario-->
    <script src="../public/js/calendar.js"></script>
    <script src="../public/js/calendar-es.js"></script>
    <script src="../public/js/calendar-setup.js"></script>
    <script language="JavaScript" src="../public/js/jquery.js"></script>
    <script language="JavaScript" src="../public/js/jquery.watermarkinput.js"></script>

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
    url: "search.php",//la url adonde se va a mandar la cadena a buscar
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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <meta http-equiv="conten-type" content="text/html; charset=UTF-8" />
    
</head>
<body>
    <?php include("../connect/conexion.php"); ?>
    <?php session_start(); ?>
    <?php include("../connect/expirar.php"); ?>
    <!-- Navigation -->
    <body>
    <?php include("../connect/conexion.php"); ?>
    <?php session_start(); ?>
    <?php include("../connect/expirar.php"); ?>
    <!-- Navigation -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li class="active">
                <a class="btn navbar-btn loginRegButtons" href="../index.php">Home</a></li>
            <li>
                <a class="btn navbar-btn loginRegButtons" href="#">F.A.Q</a>
            </li>
            <li>
                <a class="btn navbar-btn loginRegButtons" href="?op=contacto">Contacto</a>
            </li>
             <li>
                             
                            <form class="btn navbar-btn loginRegButtons"href="?op=producto" method="get">
                            <div style=" width:250px; padding-left:3px; " >  

                            <input type="text" class="busca" id="caja_busqueda" name="clave" autocomplete="off"/><br />

                            </div> 
                            <div class="btn navbar-btn loginRegButtons" id="display"></div>
                            </form><p>

                        </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <?php if (isset($_SESSION['estado']) && $_SESSION['estado'] == "online") { ?>              
                        <li class="dropdown" role="menu">
                          <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                            <?php if ($_SESSION['tieneFoto']) { ?>
                            <img height="25px" width="25px" src="imagen.php?id=<?php echo $_SESSION['id'] ?>">
                        <?php } ?>Bienvenido <?php echo $_SESSION['nombre_user']; ?><span class="caret"></span>
                          </a>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="../?op=cuenta">Editar perfil</a></li>
                             <?php if ($_SESSION['tipo'] == "admin") {?>
                            <li><a href="../content/admin/administrar.php">Administrar</a></li> 
                             <?php } ?>          
                            <li class="divider"></li>
                            <li><a href="../connect/cerrar_session.php">Cerrar Sesi&oacute;n</a></li>
                          </ul> 
                        </li>           
            <?php }else{ ?>
                     <li>
                     <a type="button" href="../?op=login" class="btn navbar-btn loginRegButtons"><i class="fa fa-sign-in"></i> Iniciar Sesi&oacute;n</a>
                     </li>
                     <li>
                     <a type="button" href="../?op=registro" class="btn navbar-btn loginRegButtons"><i class="fa fa-pencil"></i> Regitrarse</a>
                     </li>
              <?php } ?>
        </ul>
    </div>
<?php
    $query = "SELECT * FROM categorias ORDER BY nombre_cat";   // Consulta de las categorias
    $res = mysqli_query($link,$query);
?>
<div class="container paddingWithoutNav">
        <div class="row">
            <div class="col-md-4">
                <p class="lead">Bestnid - Subastas</p>
                <!--<div class="list-group"> -->
                <ul id="side">
                    <?php
                    while ($tupla = mysqli_fetch_array($res)) { ?>
                            <li><a href="productos.php?idC=<?php echo $tupla['idCategoria']; ?>"><?php echo $tupla["nombre_cat"]; ?></a></li>
                    <?php  
                        } 
                    ?>
                </ul>
                <!--</div> -->
            </div>
            <div class="col-md-8">
                
                <div style="float:right">
                    <i class="fa fa-calendar"></i> <a href="productos.php?idC=<?php echo $_GET['idC']; ?>&orden1=<?php echo "DESC"; ?>" title="Lo que no esta por terminar"><i class="fa fa-arrow-up"></i></a> <a href="productos.php?idC=<?php echo $_GET['idC']; ?>&orden2=<?php echo "ASC"; ?>" title="Lo que esta por terminar"><i class="fa fa-arrow-down"></i></a>
                    <i class="fa fa-eye"></i> <a href="productos.php?idC=<?php echo $_GET['idC']; ?>&orden3=<?php echo "DESC"; ?>" title="Lo mas vistos"><i class="fa fa-arrow-up"></i></a> <a href="productos.php?idC=<?php echo $_GET['idC']; ?>&orden4=<?php echo "ASC"; ?>" title="Lo menos visto"><i class="fa fa-arrow-down"></i></a>
                </div>
                <div style="clear:both"></div>   <!-- Uso esto para que no se me junte con el DIV de abajo -->
                <div style="clear:both"></div>   <!-- Uso esto para que no se me junte con el DIV de abajo -->
                <div class="row">
                    <?php 
                        $orden = "idProducto";
                        $tipoOrden = "ASC";
                        if (isset($_GET['orden1'])) {
                            $orden = "fecha_fin";
                            $tipoOrden = "DESC";
                        }
                        if (isset($_GET['orden2'])) {
                            $orden = "fecha_fin";
                            $tipoOrden = "ASC";
                        }
                        if (isset($_GET['orden3'])) {
                            $orden = "visitas";
                            $tipoOrden = "DESC";
                        }
                        if (isset($_GET['orden4'])) {
                            $orden = "visitas";
                            $tipoOrden = "ASC";
                        }
                        $idCat = $_GET['idC'];
                        $queryPro = "SELECT idProducto, nombre, descripcionCorta, visitas, fecha_fin FROM productos WHERE idCategoria = $idCat ORDER BY $orden $tipoOrden";
                        $resPro = mysqli_query($link,$queryPro);
                        $resContarPro = mysqli_query($link,$queryPro);
                        $cantidadDePro = mysqli_num_rows($resContarPro);
                        if ($cantidadDePro > 0) {
                        while ($tuplaPro = mysqli_fetch_array($resPro)) {
                    ?>
                    <!-- Inicia el primer producto -->
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img style="max-width: 320px; max-height: 150px;" src="imagen_portada.php?idPro=<?php echo $tuplaPro['idProducto']; ?>" >
                            <div class="caption">
                                <h4 class="pull-right"></h4>
                                <h4><a href="#"><?php echo $tuplaPro['nombre']; ?></a></h4>
                                <p><?php echo $tuplaPro['descripcionCorta']; ?></p>
                            </div>
                            <div class="ratings">
                                <p class="pull-right"><?php echo $tuplaPro['visitas']." "; ?><i class="fa fa-eye"></i></p>
                                <p><?php echo $tuplaPro['fecha_fin']." "; ?><i class="fa fa-calendar"></i></p>
                            </div>
                        </div>
                    </div>
                    <!-- Finaliza el primer producto -->
                    <?php } 
                    }else{ ?>
                        <h3><p>Todavia no existen productos que se subasten para esta categoria. </p></h3>
                    <?php } ?>
                </div>

            </div>

        </div>

    </div>
    <div class="container">
        <hr>
        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-sm-12">
                    <center><p>Copyright &copy; Your Website 2014</p></center>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="../public/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../public/js/bootstrap.min.js"></script>

</body>

</html>