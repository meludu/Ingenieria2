    <?php
    error_reporting(E_ALL ^ E_NOTICE);
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

                    $queryDestacados = "SELECT p.idProducto, p.portada, p.tipoPortada, COUNT(o.idOferta) AS cantidad FROM ofertas o INNER JOIN productos p ON(o.idProducto = p.idProducto) GROUP BY p.idProducto, p.portada, p.tipoPortada ORDER BY cantidad DESC LIMIT 3";   
                    $resDestacados = mysqli_query($link,$queryDestacados);

                ?>
                <div class="row carousel-holder">
                    <div class="col-md-12">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <?php
                                    $n1 = 0;
                                    $tipo1 = "active";
                                    for ($i = 0; $i < 3; $i++) { ?>
                                        <li data-target="#carousel-example-generic" data-slide-to="<?php echo $n1; ?>" class="<?php echo $tipo1; ?>"></li>
                                    <?php
                                        $n1 += 1; 
                                        $tipo1 = " ";
                                    }
                                    ?>
                            </ol>
                            <div class="carousel-inner">
                            <?php
                                $tipo2 = "active";
                                while ($tuplaDestacados = mysqli_fetch_array($resDestacados)) {
                            ?>
                                <div class="item <?php echo $tipo2; ?>">
                                    <a href="index.php?op=publicacion&idP=<?php echo $tuplaDestacados['idProducto']; ?>"><img class="slide-image" style="width: 850px; height: 300px;" src="content/imagen_portada.php?idPro=<?php echo $tuplaDestacados['idProducto']; ?>" alt=""></a>
                                </div>
                                <?php $tipo2 = " "; 
                                }
                                ?>
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
                <div class="row" style="margin-bottom: 10px;">
                     <div class="col-md-7 col-md-offset-3">
                        <div>
                            <span class="orderSpan"><i class="fa fa-calendar" style="margin-right:5px;"></i> <a class="btn btn-default linkOrder" href="<?php echo $baseurl . "orden1=DESC"; ?>" title="Lo que no esta por terminar"><i class="fa fa-sort-amount-asc"></i></a> <a class="btn btn-default linkOrder" href="<?php echo $baseurl . "orden2=ASC"; ?>" title="Lo que esta por terminar"><i class="fa fa-sort-amount-desc"></i></a></span>
                            <span><i class="fa fa-arrow-left" style="margin-right:5px;"></i>Ordenar<i class="fa fa-arrow-right" style="margin-left:5px;"></i></span>
                            <span class="orderSpan"></span><i class="fa fa-eye" style="margin-right:5px;"></i> <a class="btn btn-default linkOrder" href="<?php echo $baseurl . "orden3=DESC"; ?>" title="Lo mas vistos"><i class="fa fa-sort-amount-asc"></i></a> <a class="btn btn-default linkOrder" href="<?php echo $baseurl . "orden4=ASC"; ?>" title="Lo menos visto"><i class="fa fa-sort-amount-desc"></i></i></a></span>    
                        </div>
                     </div>           
                </div>
                   
                    <?php 
                      
                    $resPro = mysqli_query($link,$queryPro);
                    $cantidadDePro = mysqli_num_rows($resPro);
                    if($cantidadDePro==0){
                          ?>
                        <b>No existe producto </b></p>
                        <a class="enlace" href="index.php">Volver al inicio</a>
                      <?php
                     }   
                    while ($tuplaPro = mysqli_fetch_array($resPro)) {
                    ?>
                
                <!-- Inicia el primer producto -->
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img style="max-width: 320px; max-height: 150px;" src="content/imagen_portada.php?idPro=<?php echo $tuplaPro['idProducto']; ?>" >
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