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
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <meta http-equiv="conten-type" content="text/html; charset=UTF-8" />
    
</head>
<body>
    <?php include("/../connect/conexion.php"); ?>
    <?php session_start(); ?>
    <?php include("/../connect/expirar.php"); ?>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="row">
            <div class="container col-sm-9">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="../index.php"><img src="../public/img/logo.png" width="30px" height="30px"></a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="../index.php">Inicio</a>
                        </li>
                        <li>
                            <a href="#">F.A.Q</a>
                        </li>
                        <li>
                            <a href="?op=contacto">Contacto</a>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container -->
            <div id="log-sig" class="col-sm-3 pull-right">
                <?php if (isset($_SESSION['estado']) && $_SESSION['estado'] == "online") { ?>
                        <?php if ($_SESSION['tieneFoto']) { ?>
                            <img height="25px" width="25px" src="../content/imagen.php?id=<?php echo $_SESSION['id'] ?>">
                        <?php } ?>
                        <a href="../?op=cuenta"><i class="fa fa-sign-in"></i> Mi cuenta</a>
                         <a href="../connect/cerrar_session.php"><i class="fa fa-sign-in"></i> Cerrar Sesi&oacute;n</a>
                    <?php }else{ ?>
                        <a href="../?op=login"><i class="fa fa-sign-in"></i> Iniciar Sesi&oacute;n</a>
                        <a href="../?op=registro"><i class="fa fa-pencil"></i> Regitrarse</a>
                    <?php } ?>
            </div>
        </div>
    </nav>
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