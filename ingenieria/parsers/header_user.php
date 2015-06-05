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
                    <a class="navbar-brand" href="index.php"><img src="public/img/logo.png" width="30px" height="30px"></a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="index.php">Inicio</a>
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
                            <img height="25px" width="25px" src="content/imagen.php?id=<?php echo $_SESSION['id'] ?>">
                        <?php } ?>
                        <a href="?op=cuenta"><i class="fa fa-sign-in"></i> Mi cuenta</a>
                        <a href="connect/cerrar_session.php"><i class="fa fa-sign-in"></i> Cerrar Sesi&oacute;n<?php echo $_SESSION['start']; ?></a>
                    <?php }else{ ?>
                        <a href="?op=login"><i class="fa fa-sign-in"></i> Iniciar Sesi&oacute;n</a>
                        <a href="?op=registro"><i class="fa fa-pencil"></i> Regitrarse</a>
                    <?php } ?>
            </div>
        </div>
    </nav>