<body>
    <?php include("/../connect/conexion.php"); ?>
    <?php session_start(); ?>
    <!-- Navigation -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav">
            <li class="active">
            	<a href="index.php">Home</a></li>
            <li>
                <a href="#">F.A.Q</a>
            </li>
            <li>
                <a href="?op=contacto">Contacto</a>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
        	<?php if (isset($_SESSION['estado']) && $_SESSION['estado'] == "online") { ?>              
                        <li class="dropdown" role="menu">
                          <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                            <?php if ($_SESSION['tieneFoto']) { ?>
                            <img height="25px" width="25px" src="content/imagen.php?id=<?php echo $_SESSION['id'] ?>">
                        <?php } ?>Bienvenido <?php echo $_SESSION['nombre_user']; ?><span class="caret"></span>
                          </a>
                          <ul class="dropdown-menu" role="menu">
                          	<li><a href="?op=cuenta">Editar perfil</a></li>
                             <?php if ($_SESSION['tipo'] == "admin") {?>
                            <li><a href="content/admin/administrar.php">Administrar</a></li> 
                             <?php } ?>          
                            <li class="divider"></li>
                            <li><a href="connect/cerrar_session.php">Cerrar Sesi&oacute;n</a></li>
                          </ul>	
                        </li>           
            <?php }else{ ?>
                	 <li>
                	 <a type="button" href="?op=login" class="btn navbar-btn loginRegButtons"><i class="fa fa-sign-in"></i> Iniciar Sesi&oacute;n</a>
                	 </li>
                	 <li>
					 <a type="button" href="?op=registro" class="btn navbar-btn loginRegButtons"><i class="fa fa-pencil"></i> Regitrarse</a>
					 </li>
	          <?php } ?>
        </ul>
    </div>
    