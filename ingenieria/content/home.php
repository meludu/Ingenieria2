    <?php
    error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
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
    
    if(isset($_GET['clave'])){
        if($_GET['clave']==''){
        ?>
        <script type="text/javascript">window.location='index.php'</script>
        <?php
        }
    }
    $palabra=$_GET['clave'];
    ?>


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

        if (isset($_GET['clave']) && $_GET['clave'] != ""){
            $baseurl = "index.php?clave=" . $_GET['clave'] . "&";
            $queryPro = "SELECT * FROM productos WHERE  nombre LIKE '%$palabra%'or descripcionCorta like'%$palabra%' ORDER BY $orden $tipoOrden";
        }
        else{
            $baseurl = "index.php?";
            $queryPro = "SELECT idProducto, nombre, descripcionCorta, visitas, fecha_fin FROM productos ORDER BY $orden $tipoOrden";
        }
                        
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
                            <li><a href="?op=prod&idC=<?php echo $tupla['idCategoria']; ?>"><?php echo utf8_encode($tupla["nombre_cat"]); ?></a></li>                           
                    <?php  
                        } 
                    ?>
                </ul>
                <!--</div> -->
            </div>
            <div class="col-md-8">
                <?php
                if(!isset($_GET['clave'])){
                                               
                ?>
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
                 <?php
                     }
                    ?>
               <!-- <div class="row" style="margin-bottom: 10px;">
                     <div class="col-md-7 col-md-offset-3">
                        <div style="float:right">
                            <span class="orderSpan"><i class="fa fa-calendar" style="margin-right:5px;"></i> <a class="btn btn-default linkOrder" href="<?php echo $baseurl . "orden1=DESC"; ?>" title="Lo que no esta por terminar"><i class="fa fa-sort-amount-asc"></i></a> <a class="btn btn-default linkOrder" href="<?php echo $baseurl . "orden2=ASC"; ?>" title="Lo que esta por terminar"><i class="fa fa-sort-amount-desc"></i></a></span>
                            <span><i class="fa fa-arrow-left" style="margin-right:5px;"></i>Ordenar<i class="fa fa-arrow-right" style="margin-left:5px;"></i></span>
                            <span class="orderSpan"></span><i class="fa fa-eye" style="margin-right:5px;"></i> <a class="btn btn-default linkOrder" href="<?php echo $baseurl . "orden3=DESC"; ?>" title="Lo mas vistos"><i class="fa fa-sort-amount-asc"></i></a> <a class="btn btn-default linkOrder" href="<?php echo $baseurl . "orden4=ASC"; ?>" title="Lo menos visto"><i class="fa fa-sort-amount-desc"></i></i></a></span>    
                        </div>
                     </div>           
                </div>-->
                   
                    <?php 
                      
                    $resPro = mysqli_query($link, $queryPro);
                    $cantidadDePro = mysqli_num_rows($resPro);
                    if($cantidadDePro==0){
                          ?>
                        <b>No existe producto </b></p>
                        <a class="enlace" href="index.php">Volver al inicio</a>
                      <?php
                     }   
                     else{?>
                             <div class="row" style="margin-bottom: 10px;">
                     <div class="col-md-7 col-md-offset-3">
                        <div style="float:right">
                            <span class="orderSpan"><i class="fa fa-calendar" style="margin-right:5px;"></i> <a class="btn btn-default linkOrder" href="<?php echo $baseurl . "orden1=DESC"; ?>" title="Lo que no esta por terminar"><i class="fa fa-sort-amount-asc"></i></a> <a class="btn btn-default linkOrder" href="<?php echo $baseurl . "orden2=ASC"; ?>" title="Lo que esta por terminar"><i class="fa fa-sort-amount-desc"></i></a></span>
                            <span><i class="fa fa-arrow-left" style="margin-right:5px;"></i>Ordenar<i class="fa fa-arrow-right" style="margin-left:5px;"></i></span>
                            <span class="orderSpan"></span><i class="fa fa-eye" style="margin-right:5px;"></i> <a class="btn btn-default linkOrder" href="<?php echo $baseurl . "orden3=DESC"; ?>" title="Lo mas vistos"><i class="fa fa-sort-amount-asc"></i></a> <a class="btn btn-default linkOrder" href="<?php echo $baseurl . "orden4=ASC"; ?>" title="Lo menos visto"><i class="fa fa-sort-amount-desc"></i></i></a></span>    
                        </div>
                     </div>           
                </div>
                    <?php
                     }
                    while ($tuplaPro = mysqli_fetch_array($resPro)) {
                    ?>
                
                <!-- Inicia el primer producto -->
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <a href="?op=publicacion&idP=<?php echo $tuplaPro['idProducto']; ?>"><img style="max-width: 320px; max-height: 150px;" src="content/imagen_portada.php?idPro=<?php echo $tuplaPro['idProducto']; ?>" ></a>
                            <div class="caption">
                                <h4 class="pull-right"></h4>
                                <h4 ><a class="sar" href="?op=publicacion&idP=<?php echo $tuplaPro['idProducto']; ?>"><?php echo utf8_encode($tuplaPro['nombre']); ?></a></h4>
                                <p class="descrip"><?php echo utf8_encode($tuplaPro['descripcionCorta']); ?></p>
                            </div>
                            <div class="ratings">
                                <p class="pull-right"><?php echo $tuplaPro['visitas']." "; ?><i class="fa fa-eye"></i></p>
                                <p ><?php echo $tuplaPro['fecha_fin']." "; ?><i class="fa fa-calendar"></i></p>
                            </div>
                        </div>
                    </div>
                    <!-- Finaliza el primer producto -->
                    <?php }
                    
                    ?>

                </div>

            </div>

        </div>

    </div>
    <!-- /.container -->
    <?php
    }
    ?>