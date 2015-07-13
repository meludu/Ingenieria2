    <script language="JavaScript" type="text/javascript"> 
        function contador (campo, cuentacampo, limite) { 
            if (campo.value.length > limite) campo.value = campo.value.substring(0, limite); 
            else cuentacampo.value = limite - campo.value.length; 

        } 
    </script>

    <?php
        session_start();

        // Selecciono el producto.
        $queryPro = "SELECT * FROM productos WHERE idProducto = '".$_GET['idP']."' ";
        $resPro = mysqli_query($link,$queryPro);
        $tuplaPro = mysqli_fetch_array($resPro);
  // Incremento la cantidad de vistos.
        if ($_SESSION['tipo'] == "usuario" && $_SESSION['id'] != $tuplaPro['idUsuario']){
        $queryVistos = "UPDATE productos SET visitas = visitas + 1 WHERE idProducto = '".$_GET['idP']."' ";
        mysqli_query($link,$queryVistos);
        }

        // Para ver si el usuario ya oferto 
        $queryOfe = "SELECT * FROM ofertas WHERE idProducto = '".$tuplaPro['idProducto']."' AND idUsuario = '".$_SESSION['id']."' ";
        $resOfe = mysqli_query($link,$queryOfe);
        $cantOfe = mysqli_num_rows($resOfe);    // si es 1 ya oferto, si es 0 nunca oferto

        $queryOfe2= "SELECT * from ofertas o INNER jOIN productos p ON(p.idProducto=o.idProducto) WHERE p.idProducto = '".$tuplaPro['idProducto']."' AND p.idUsuario = '".$_SESSION['id']."' ";
         $resOfe2= mysqli_query($link,$queryOfe2);
         $cantOfe2 = mysqli_num_rows($resOfe2);
    if ($tuplaPro == false){
        ?>
        <script>
        window.location='index.php';
        </script>
    <?php
    }
    else {

    ?>
    <!-- Page Content -->
    <div class="container paddingWithoutNav">

        <div class="row">
        <div class="col-md-3">
                <p class="lead">Bestnid - Subastas</p>
                <div class="list-group">

                <?php 
                $consultaFecha = "SELECT CURDATE()"; 
                $resFecha = mysqli_query($link,$consultaFecha); 
                $fechaActual = mysqli_fetch_array($resFecha); 
                include_once("connect/calcular_fecha.php");
                if (isset($_SESSION['estado']) && $_SESSION['estado'] == "online") {
                    if ($_SESSION['tipo'] == "usuario" && $_SESSION['id'] != $tuplaPro['idUsuario']) { // si id del usuario logeado es distinto al dueñod e la publicacion, entro
                        $_SESSION['prod'] = $tuplaPro['idProducto'];   // Hago esto para poder enviar al archivo el id del producto.
                      if(interval_date($fechaActual[0],$tuplaPro['fecha_fin'])<>"Publicaci&oacute;n finalizada."){
                        if ($cantOfe == 0) {
                            require("boton_ofertas.php");
                        }else{
                            echo "<h3 style='color: white;'>Ya ofertaste. </h3>"; 
                            $tuplaOfe = mysqli_fetch_array($resOfe);    
                            $_SESSION['oferta'] = $tuplaOfe['idOferta']; // Me quedo con el id de la oferta para enviarlo.
                            require("modificar_oferta.php"); ?>
                            <br><?php
                            require("eliminar_oferta.php");
                        }

                      }else if ($_SESSION['tipo'] == "usuario" && $_SESSION['id'] == $tuplaPro['idUsuario']) { ?>
                        <a href="?op=editarPubl&idP=<?php echo $_GET['idP']; ?>"><button type="button" class="btn btn-success btn-lg btn-block">Editar</button></a><br>
                        <?php 
                        require("borrar_publicacion.php");
                      }
                    }
                    else{
                       
                        ?>
                        <a type="button" href="?op=login" class="btn btn-success btn-lg btn-block"> ofertar</a>
                        <?php
                       
                    }
                ?>
                <br>
                <!-- Mensaje del error
                <div class="alert alert-success" role="alert">
                    <p>La publicaci&oacute;n fue modificada. </p>
                </div> -->
                </div>
            </div>


            <div class="col-md-9">
                <div class="thumbnail">
                   
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
                        else{
                            ?>
                            <img  class="papa"onmouseover="this.width=500;this.height=400;" onmouseout="this.width=100;this.height=80;" width="100" height="80" alt="" src="content/imagen_portada.php?idPro=<?php echo $tuplaPro['idProducto']; ?>">
                            <?php

                        }
                    ?>
                    <!-- TERMINA ACA -->

                    <div class="caption-full">
                        <h4 class="pull-right"><i>Se publico el: <?php echo $tuplaPro['fecha_ini']; ?></i></h4>
                        <h4><?php echo utf8_encode( $tuplaPro['nombre']); ?></h4>
                        <p><?php echo  utf8_encode($tuplaPro['descripcionCorta']); ?></p>
                        <br/>
                        <p><?php echo  utf8_encode($tuplaPro['descripcionLarga']); ?></p>
                    </div>
                    <?php 
                        $consultaFecha = "SELECT CURDATE()"; 
                        $resFecha = mysqli_query($link,$consultaFecha); 
                        $fechaActual = mysqli_fetch_array($resFecha); 
                        //include("connect/calcular_fecha.php");
                    ?>                  
                    <div class="ratings">
                        <p class="pull-right"><?php echo $tuplaPro['visitas']." "; ?><i class="fa fa-eye"></i></p>
                        <p  ><?php echo interval_date($fechaActual[0],$tuplaPro['fecha_fin']); ?></p>
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
                            $consPre = "SELECT u.nombre AS nombUser, u.apellido AS apeUser, p.pregunta AS preg, p.fecha AS fechaPre, p.hora AS horaPre, p.idPregunta AS idPre FROM usuarios u INNER JOIN preguntas p on(u.idUsuario = p.idUsuario) INNER JOIN preguntas_productos pp ON(p.idPregunta = pp.idPregunta) INNER JOIN productos pro ON(pp.idProducto = pro.idProducto) WHERE pro.idProducto = '".$_GET['idP']."' ORDER BY pp.idPreguntaProducto";
                            $resPre = mysqli_query($link,$consPre);
                    ?>
                    <hr>
                    <?php while($tuplaPre = mysqli_fetch_array($resPre)) { ?>
                        <!-- PARA RESPONDER LAS PREGUNTAS. () -->
                            <script type="text/javascript">
                                $(document).ready(function(){
                                     $(".btn<?php echo $tuplaPre['idPre'] ?>").click(function () {    
                                        $(".div<?php echo $tuplaPre['idPre'] ?>").toggle("slow");
                                    });
                                });
                            </script> <!-- Lo pongo dentro del bucle while -->
                            <?php 
                                // Traigo la informacion de la respuesta que dio el dueño de la publicacion.
                                $conRes = "SELECT * FROM respuestas WHERE idPregunta = '".$tuplaPre['idPre']."' ";
                                $resres = mysqli_query($link,$conRes);
                                $numRes = mysqli_num_rows($resres);
                            ?>
                    <div class="row">
                        <div class="col-md-12">
                            <?php echo utf8_encode($tuplaPre['apeUser']." ".$tuplaPre['nombUser']); ?>
                            <span class="pull-right"><?php echo "El ".$tuplaPre['fechaPre']." a las ".$tuplaPre['horaPre']; ?></span>
                            <p class="puntos"><?php echo htmlspecialchars(utf8_encode($tuplaPre['preg'])); ?></p>

                    <?php if ($tuplaPro['idUsuario'] == $_SESSION['id'] && $numRes == 0) {  // Si el usuario logeado es igual al dueño de la publicacion. ?>
                            <button class="btn<?php echo $tuplaPre['idPre'] ?>" style="border:none; background-color:transparent; outline: 0; float: right;"><i class="fa fa-comment"></i></button>
                            <div class="div<?php echo $tuplaPre['idPre'] ?> col-md-12" style="display:none; z-index: 9999;">
                                <form method="POST" name="comentario" action="connect/enviar_respuesta.php">
                                    <textarea class="form-control" onKeyDown="contador(this.form.texto,this.form.remLen,255);" onKeyUp="contador(this.form.texto,this.form.remLen,255);" style="resize:none;" name="texto" rows="3" cols="112" ></textarea><br/> 
                                    <input type="text" style="border:none; background-color:transparent;" name="remLen" value="255" disabled readonly>
                                    <input type="hidden" name="preg" value="<?php echo $tuplaPre['idPre']; ?>">
                                    <input type="hidden" name="elProd" value="<?php echo $_GET['idP']; ?>">
                                    <input class="btn btn-primary" style="float:right;" type="submit" name="boton" value="Responder">
                                </form>
                            </div>
                    <?php }elseif ($numRes != 0) {
                            $conRes2 = "SELECT r.respuesta AS respuesta, u.nombre AS nombre, u.apellido AS apellido, r.fecha AS f, r.hora AS h FROM respuestas r INNER JOIN preguntas p ON(r.idPregunta = p.idPregunta) INNER JOIN preguntas_productos pp ON(p.idPregunta = pp.idPregunta) INNER JOIN productos pro ON(pp.idProducto = pro.idProducto) INNER JOIN usuarios u ON(pro.idUsuario = u.idUsuario) WHERE pro.idProducto = '".$_GET['idP']."' AND r.idPregunta = '".$tuplaPre['idPre']."' ";
                            $resres2 = mysqli_query($link,$conRes2);
                            $tuplaRes = mysqli_fetch_array($resres2); ?>
                            <?php echo "<i style='color: #836690;'>".utf8_encode($tuplaRes['apellido']).", ".utf8_encode($tuplaRes['nombre'])."</i>"; ?>
                            <span class="pull-right"><?php echo "El ".$tuplaRes['f']." a las ".$tuplaRes['h']; ?></span>
                            <p class="puntos"><?php echo htmlspecialchars( utf8_encode($tuplaRes['respuesta'])); ?></p>
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
                                <textarea class="form-control" onKeyDown="contador(this.form.texto,this.form.remLen,255);" onKeyUp="contador(this.form.texto,this.form.remLen,255);" style="resize:none;" name="texto" rows="3" cols="112" required></textarea><br/> 
                                <input type="text" style="border:none; background-color:transparent;" name="remLen" value="255" disabled readonly>
                                <input type="hidden" name="elProd" value="<?php echo $_GET['idP']; ?>">
                                <input class="btn btn-primary" style="float:right;" type="submit" name="boton" value="Comentar">                        
                            </form>
                        </div>
                    </div>
                    <?php   }else{ ?> 
                                <center><p>No puedes comentar tu publicaci&oacute;n!</p></center>
                      <?php } ?>
                    <?php }   ?>
                </div>

            </div>

        </div>

    </div>
    <!-- /.container -->
<?php } ?>