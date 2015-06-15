    <script language="JavaScript" type="text/javascript"> 
        function contador (campo, cuentacampo, limite) { 
            if (campo.value.length > limite) campo.value = campo.value.substring(0, limite); 
            else cuentacampo.value = limite - campo.value.length; 
        } 
    </script>

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
    <div class="container">

        <div class="row">
        <div class="col-md-3">
                <p class="lead">Shop Name</p>
                <div class="list-group">
                    <a href="#" class="list-group-item active">Category 1</a>
                    <a href="#" class="list-group-item">Category 2</a>
                    <a href="#" class="list-group-item">Category 3</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="thumbnail">
                    <!-- <img class="img-responsive" src="http://placehold.it/800x300" alt="">  ESTE ERA EL ORIGINAL ANTES -->

                    <!-- eSTE ES IGUAL AL DEL HOME PARA PROBAR -->
                    <?php
                        $queryCantImg = "SELECT COUNT(*) FROM imagenes i INNER JOIN productos p ON(i.idProducto = p.idProducto) WHERE p.idProducto = '".$_GET['idP']."' ";
                        $resCantImg = mysqli_query($link,$queryCantImg);
                        $cantImg = mysqli_fetch_array($resCantImg);

                        if ($cantImg[0] > 0) {

                            $queryImg = "SELECT * FROM imagenes WHERE idProducto = '".$_GET['idP']."' ";
                            $resImg = mysqli_query($link,$queryImg);
                    ?>
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                            <?php 
                                $n1 = 0;
                                $tipo1 = "active";
                                for ($i = $cantImg[0]; $i > 0; $i--) {
                            ?>
                                <li data-target="#carousel-example-generic" data-slide-to="<?php echo $n1; ?>" class="<?php echo $tipo1; ?>"></li>
                                <?php $n1 += 1; $tipo1 = " "; ?>
                            <?php
                                }
                            ?>
                            </ol>
                            <div class="carousel-inner">
                            <?php
                                $tipo2 = "active";
                                while ($tuplaImg = mysqli_fetch_array($resImg)) {
                            ?>
                                <div class="item <?php echo $tipo2; ?>">
                                    <img class="slide-image" style="width: 850px; height: 300px;" src="<?php echo $tuplaImg['url']; ?>" alt="">
                                </div>
                                <?php $tipo2 = " "; ?>
                            <?php
                                }
                            ?>
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                            </a>
                        </div>

                    <?php
                        }
                    ?>
                    <!-- TERMINA ACA -->

                    <div class="caption-full">
                        <h4 class="pull-right"><i>Se publico el: <?php echo $tuplaPro['fecha_ini']; ?></i></h4>
                        <h4><a href="#"><?php echo $tuplaPro['nombre']; ?></a>
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
                    <?php
                        // Si hay mas de 0 preguntas
                        if ($cantidadPre[0] > 0) {
                            // Traigo la informacion del usuario junto a la pregunta que realizo. 
                            $consPre = "SELECT u.nombre AS nombUser, u.apellido AS apeUser, p.pregunta AS preg, p.fecha AS fechaPre, p.hora AS horaPre FROM usuarios u INNER JOIN preguntas p on(u.idUsuario = p.idUsuario) INNER JOIN preguntas_productos pp ON(p.idPregunta = pp.idPregunta) INNER JOIN productos pro ON(pp.idProducto = pro.idProducto) WHERE pro.idProducto = '".$_GET['idP']."' ORDER BY pp.idPreguntaProducto";
                            $resPre = mysqli_query($link,$consPre);
                    ?>
                    <hr>
                    <?php while($tuplaPre = mysqli_fetch_array($resPre)) { ?>
                    <div class="row">
                        <div class="col-md-12">
                            <?php echo $tuplaPre['apeUser']." ".$tuplaPre['nombUser']; ?>
                            <span class="pull-right"><?php echo "El ".$tuplaPre['fechaPre']." a las ".$tuplaPre['horaPre']; ?></span>
                            <p><?php echo $tuplaPre['preg']; ?></p>
                            <?php if ($tuplaPro['idUsuario'] == $_SESSION['id']) {  // Si el usuario logeado es igual al dueño de la publicacion. ?>
                            <!--<input class="btn btn-primary" style="float:right;" name="boton" value="Responder">-->
                            <button name="reslo" class="boton">Responder</button>
                            <div name="div" class="target" style="display:none; z-index: 9999;">Aca debo mostrar un formulario para cada pregunta.</div>
                            <?php } ?>
                        </div>
                    </div>
                    <hr>
                    <?php } // fin While
                        }else{ // fin if ?>
                        <center><p>No hay comentarios!</p></center>
                    <?php }?>    
                    <?php
                        // $_SESSION['tipo'] == "usuario" compruebo que no sea admin, porque los administradores no pueden ofertar ni hacer preguntas.
                        if (isset($_SESSION['estado']) && $_SESSION['estado'] == "online" && $_SESSION['tipo'] == "usuario") {  // Para escribir un comentario el usuario debe iniciar sesion
                            if ($_SESSION['id'] != $tuplaPro['idUsuario']) {    // Veo si el usuario logeado es distinto al dueño de la publicacion
                    ?>
                    <div class="row">
                        <div class="col-md-12">
                            <p>Escribe un comentario: </p>
                            <form action="connect/enviar_comentario.php" method="POST" name="comentario">
                                <textarea class="form-control" onKeyDown="contador(this.form.texto,this.form.remLen,255);" onKeyUp="contador(this.form.texto,this.form.remLen,255);" style="resize:none;" name="texto" rows="3" cols="112" ></textarea><br/> 
                                <input type="text" style="border:none; background-color:transparent;" name="remLen" value="255" disabled readonly>
                                <input type="hidden" name="elProd" value="<?php echo $_GET['idP']; ?>">
                                <input class="btn btn-primary" style="float:right;" type="submit" name="boton" value="Comentar">                        
                            </form>
                        </div>
                    </div>
                    <?php   } ?> 
                    <center><p>No puedes comentar tu publicaci&oacute;n!</p></center>
                    <?php }   ?>
                </div>

            </div>

        </div>

    </div>
    <!-- /.container -->
