    <?php
    include_once("/../parsers/head.php");
    include_once("/../helpers/chequear_url.php");

    if(urlExist("http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'])){
        ?>
        <div class="alert alert-danger" role="alert">
            <strong>Error!</strong>, <a href="../index.php" class="alert-link">ir al index</a>.
        </div>
    <?php
    }
    else
    {
    $query = "SELECT * FROM categorias ORDER BY nombre_cat";   // Consulta de las categorias
    $res = mysqli_query($link,$query);
    ?>
    <!-- Page Content -->
    <div class="container paddingWithoutNav">
        <div class="row">
            <div id="side" class="col-md-4">
                <div class="panel panel-danger">
                    <div class="panel-heading box-shadow-5">
                        <h4>B&uacute;squeda por categor&iacute;a</h4>    
                    </div>
                    <div class="panel-body">
                        <ul>
                        <?php
                        while ($tupla = mysqli_fetch_array($res)) { ?>                    
                                <li><a href="?op=prod&idC=<?php echo $tupla['idCategoria']; ?>"><?php echo $tupla["nombre_cat"]; ?></a></li>                           
                        <?php  
                            } 
                        ?>
                    </ul>    
                    </div>
                </div>
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
                <div class="row" style="margin-bottom: 10px;">
                     <div class="col-md-8 col-md-offset-5">
                        <div>
                            <span class="orderSpan"><i class="fa fa-calendar" style="margin-right:5px;"></i> <a class="btn btn-default linkOrder" href="index.php?orden1=<?php echo "DESC"; ?>" title="Lo que no esta por terminar"><i class="fa fa-sort-amount-asc"></i></a> <a class="btn btn-default linkOrder" href="index.php?orden2=<?php echo "ASC"; ?>" title="Lo que esta por terminar"><i class="fa fa-sort-amount-desc"></i></a></span>
                            <span><i class="fa fa-arrow-left" style="margin-right:5px;"></i>Ordenar<i class="fa fa-arrow-right" style="margin-left:5px;"></i></span>
                            <span class="orderSpan"></span><i class="fa fa-eye" style="margin-right:5px;"></i> <a class="btn btn-default linkOrder" href="index.php?orden3=<?php echo "DESC"; ?>" title="Lo mas vistos"><i class="fa fa-sort-amount-asc"></i></a> <a class="btn btn-default linkOrder" href="index.php?orden4=<?php echo "ASC"; ?>" title="Lo menos visto"><i class="fa fa-sort-amount-desc"></i></i></a></span>    
                        </div>
                     </div>           
                </div>
                <div class="row well">
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
                    <div class="col-xs-12 col-sm-6">
                        <div class="thumbnail">
                            <img style="max-width: 320px; max-height: 150px;" src="content/imagen_portada.php?idPro=<?php echo $tuplaPro['idProducto']; ?>" >
                            <div class="caption">
                                <h4 class="pull-right"></h4>
                                <h4><a href="#"><?php echo utf8_encode($tuplaPro['nombre']); ?></a></h4>
                                <p><?php echo utf8_encode($tuplaPro['descripcionCorta']); ?></p>
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
    <?php
    }
    ?>
