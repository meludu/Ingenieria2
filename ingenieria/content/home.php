    <?php
    $query = "SELECT * FROM categorias ORDER BY nombre_cat";   // Consulta de las categorias
    $res = mysqli_query($link,$query);
    ?>
    <!-- Page Content -->
    <div class="container paddingWithoutNav">
        <div class="row">
            <div class="col-md-4">
                <p class="lead">Bestnid - Subastas</p>
                <!--<div class="list-group"> -->
                <ul id="side">
                    <?php
                    while ($tupla = mysqli_fetch_array($res)) { ?>                    
                            <li><a href="?op=prod&idC=<?php echo $tupla['idCategoria']; ?>"><?php echo $tupla["nombre_cat"]; ?></a></li>                           
                    <?php  
                        } 
                    ?>
                </ul>
                <!--</div> -->
            </div>
            <div class="col-md-8">
                <div class="row carousel-holder">
                    <div class="col-md-12">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img class="slide-image" src="http://placehold.it/800x300" alt="">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="http://placehold.it/800x300" alt="">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="http://placehold.it/800x300" alt="">
                                </div>
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                            </a>
                        </div>
                    </div>
                </div>
                <div style="float:right">
                    <i class="fa fa-calendar"></i> <a href="index.php?orden1=<?php echo "DESC"; ?>" title="Lo que no esta por terminar"><i class="fa fa-arrow-up"></i></a> <a href="index.php?orden2=<?php echo "ASC"; ?>" title="Lo que esta por terminar"><i class="fa fa-arrow-down"></i></a>
                    <i class="fa fa-eye"></i> <a href="index.php?orden3=<?php echo "DESC"; ?>" title="Lo mas vistos"><i class="fa fa-arrow-up"></i></a> <a href="index.php?orden4=<?php echo "ASC"; ?>" title="Lo menos visto"><i class="fa fa-arrow-down"></i></a>
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
                        $queryPro = "SELECT idProducto, nombre, descripcionCorta, visitas, fecha_fin FROM productos ORDER BY $orden $tipoOrden";
                        $resPro = mysqli_query($link,$queryPro);
                        while ($tuplaPro = mysqli_fetch_array($resPro)) {
                    ?>
                    <!-- Inicia el primer producto -->
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img style="max-width: 320px; max-height: 150px;" src="content/imagen_portada.php?idPro=<?php echo $tuplaPro['idProducto']; ?>" >
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
                    <?php } ?>
                </div>

            </div>

        </div>

    </div>
    <!-- /.container -->
