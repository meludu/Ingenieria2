    <?php
        // Incremento la cantidad de vistos.
        $queryVistos = "UPDATE productos SET visitas = visitas + 1 WHERE idProducto = '".$_GET['idP']."' ";
        mysqli_query($link,$queryVistos);
        // Selecciono el producto.
        $queryPro = "SELECT * FROM productos WHERE idProducto = '".$_GET['idP']."' ";
        $resPro = mysqli_query($link,$queryPro);
        $tuplaPro = mysqli_fetch_array($resPro);
    ?>
    <!-- Page Content -->
    <?php
    if ($tuplaPro==false){
        ?>
        <script type="text/javascript">window.location='index.php'</script>
        <?php
}
     else{


        ?>


        <div class="container paddingWithoutNav">

        <div class="row">

            <div class="col-md-3">
                <p class="lead">Acciones</p>
                <div class="list-group">
                    <a href="#" class="list-group-item active">Category 1</a>
                    <a href="#" class="list-group-item">Category 2</a>
                    <a href="#" class="list-group-item">Category 3</a>
                </div>
            </div>

            <div class="col-md-9">
                <div class="thumbnail">
                    <img class="img-responsive" src="content/imagen_portada.php?idPro=<?php echo $tuplaPro['idProducto']; ?>" alt="">
                    <div class="caption-full">
                        <h4 class="pull-right"><i>Se publico el: <?php echo $tuplaPro['fecha_ini']; ?></i></h4>
                        <h4><a class="sar" ><?php echo $tuplaPro['nombre']; ?></a>
                        </h4>
                        <p><?php echo $tuplaPro['descripcionCorta']; ?></p>
                        <br/>
                        <p><?php echo $tuplaPro['descripcionLarga']; ?></p>
                    </div>
                    <?php 
                        $consultaFecha = "SELECT CURDATE()"; 
                        $resFecha = mysqli_query($link,$consultaFecha); 
                        $fechaActual = mysqli_fetch_array($resFecha); 
                        include("connect/calcular_fecha.php");
                    ?>                  
                    <div class="ratings">
                        <p class="pull-right"><?php echo $tuplaPro['visitas']." "; ?><i class="fa fa-eye"></i></p>
                        <p><?php echo interval_date($fechaActual[0],$tuplaPro['fecha_fin']); ?></p>
                    </div>
                </div>

                <div class="well">
                    <?php
                        $consCantPre = "SELECT COUNT(*) FROM productos p INNER JOIN preguntas_productos pp ON(p.idProducto = pp.idProducto) INNER JOIN preguntas pre ON(pp.idPregunta = pre.idPregunta) WHERE p.idProducto = '".$_GET['idP']."' ";
                        $resCantPre = mysqli_query($link,$consCantPre);
                        $cantidadPre = mysqli_fetch_array($resCantPre);
                    ?>
                    <div class="text-right">
                        <p>Preguntas totales: <?php echo $cantidadPre[0]; ?></p>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                            Anonymous
                            <span class="pull-right">10 days ago</span>
                            <p>This product was great in terms of quality. I would definitely buy another!</p>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                            Anonymous
                            <span class="pull-right">12 days ago</span>
                            <p>I've alredy ordered another one!</p>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                            Anonymous
                            <span class="pull-right">15 days ago</span>
                            <p>I've seen some better than this, but not at this price. I definitely recommend this item.</p>
                        </div>
                    </div>
                    <?php
                        if (isset($_SESSION['estado']) && $_SESSION['estado'] == "online") {
                    ?>
                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <p>Escribe un comentario: </p>
                            <form action="" method="POST">
                                <textarea class="form-control" style="resize:none;" name="comentario" rows="3" cols="112">
                                </textarea><br/>
                                <input class="btn btn-primary" style="float:right;" type="submit" name="boton" value="Comentar">                                 
                            </form>
                        </div>
                    </div>
                    <?php } ?>
                </div>

            </div>

        </div>

    </div>

<?php } ?>

   
    <!-- /.container -->
