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
                        while ($tupla = mysqli_fetch_array($res)) { 
                            $query2 = "SELECT sc.idSubCategoria AS idsub, sc.nombre AS nomsub FROM categorias c INNER JOIN subcategorias sc ON(c.idCategoria = sc.idCategoria) WHERE sc.idCategoria = '".$tupla['idCategoria']."' ORDER BY sc.nombre ";  // Consulta de las subcategorias.
                            $res2 = mysqli_query($link,$query2) ?>
                            <li><a href="#"><?php echo $tupla["nombre_cat"]; ?></a>
                                <ul>
                                    <?php
                                    while ($tupla2 = mysqli_fetch_array($res2)) { ?>
                                        <li><a href=""><?php echo $tupla2['nomsub']; ?></a></li>
                                    <?php
                                    } ?>
                                </ul>
                            </li>
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
                <div class="row">
                    <?php 
                        $queryPro = "SELECT idProducto, nombre, descripcionCorta, visitas, fecha_fin FROM productos ";
                        $resPro = mysqli_query($link,$queryPro);
                        while ($tuplaPro = mysqli_fetch_array($resPro)) {
                    ?>
                    <!-- Inicia el primer producto -->
                
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="content/imagen_portada.php?idPro=<?php echo $tuplaPro['idProducto']; ?>" alt="">
                            <div class="caption">
                                <h4 class="pull-right"></h4>
                                <h4><a href="#"><?php echo $tuplaPro['nombre']; ?></a></h4>
                                <p><?php echo $tuplaPro['descripcionCorta']; ?></p>
                            </div>
                            <div class="ratings">
                                <p class="pull-right"><?php echo $tuplaPro['visitas']." "; ?><i class="fa fa-eye"></i></p>
                                <p>
                                    <?php echo $tuplaPro['fecha_fin']; ?>
                                </p>
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
