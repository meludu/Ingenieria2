<body>
 
    <?php include("/../connect/conexion.php"); ?>
    <?php session_start(); ?>
    <?php include("/../connect/expirar.php"); ?>



    <!-- Navigation -->
    <div class="navbar-header">
    <a href="index.php"><img  class="img"src="public/img/logo.png" href="index.php"></a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav">
            <li class="active">
            	<a class="btn navbar-btn loginRegButtons" href="index.php">Home</a></li>
            <li>
                <a class="btn navbar-btn loginRegButtons" href="?op=faq">F.A.Q</a>
            </li>
            <li>
                <a class="btn navbar-btn loginRegButtons" href="?op=contacto">Contacto</a>
            </li>
        </ul>
       <form  class="navbar-form navbar-left"  method="get">
        <div class="form-group">
          <input type="text" class="busca" id="caja_busqueda"  name="clave" autocomplete="off">
        </div>
        <button  type="submit"  class="btn navbar-btn loginRegButtons fa fa-search">Buscar</button>
         <div id="display" style="visibility:visible;">
         </div>
          

      </form>
        <!-- PRUEBA NOTIFICACION // estado = 0 visto, 1 no visto-->

        <?php
            if (isset($_SESSION['estado']) && $_SESSION['estado'] == "online") {
                $queryNoti = "SELECT * FROM notificaciones n INNER JOIN productos p ON(n.idProducto = p.idProducto) WHERE p.estado = '0' AND n.idReceptor = '".$_SESSION['id']."' AND n.estado = '1' ";
                $resNoti = mysqli_query($link,$queryNoti);
                $cantNoti = mysqli_num_rows($resNoti);
            }   
        ?>

        <!-- PRUEBA NOTIFICACION -->
        <ul class="nav navbar-nav navbar-right">
        	<?php if (isset($_SESSION['estado']) && $_SESSION['estado'] == "online") { ?>   
                        <li class="dropdown" style="margin-top:15px;"><button id="boton" style="border:none; background-color:transparent; outline: 0;"><i class="fa fa-bell" style="color: white;"></i></button><?php if ($cantNoti != 0) {echo "<stronge style='color:red;'>".$cantNoti."</stronge>"; include("notifacion.php"); }else{ echo "<stronge style='color:white;'>".$cantNoti."</stronge>"; include("notifacion.php"); } ?></li>         
                        <li class="dropdown" role="menu">
                          <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                            <?php if ($_SESSION['tieneFoto']) { ?>
                            <img height="25px" width="25px" src="content/imagen.php?id=<?php echo $_SESSION['id'] ?>">
                        <?php } ?>Bienvenido <?php echo utf8_encode( $_SESSION['nombre_user']); ?><span class="caret"></span>
                          </a>
                          <ul class="dropdown-menu" role="menu">
                        <?php if ($_SESSION['tipo'] == "usuario" ) { ?>
                            <li><a href="?op=publicar">Publicar producto</a></li>
                            <!--<li><a href="?op=cuenta">Mis ventas</a></li> -->
                            <li><a href="?op=misProds">Mis productos</a></li>
                            <li class="divider"></li>
                        <?php } ?>
                          	<li><a href="?op=cuenta">Perfil</a></li>
                            <li><a href="?op=config">Configuraci&oacute;n</a></li>
                             <?php if ($_SESSION['tipo'] == "admin") {?>
                             <!--<li><a href="?op=subastas">Subastas</a></li> -->
                            <li><a href="content/administrar.php">Administrar</a></li> 
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
