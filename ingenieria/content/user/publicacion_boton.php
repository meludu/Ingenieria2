    <script text="javascript">
        /**
         * Función que solo permite la entrada de numeros, un signo negativo y
         * un punto para separar los decimales
         */
        function soloNumeros(e) {
            // capturamos la tecla pulsada
            var teclaPulsada=window.event ? window.event.keyCode:e.which;
            // capturamos el contenido del input
            var valor=document.getElementById("exampleInputAmount").value;
            if(valor.length<10) {
                // 13 = tecla enter
                // Si el usuario pulsa la tecla enter o el punto y no hay ningun otro
                // punto
                if(teclaPulsada==13) {
                    return true;
                }
                // devolvemos true o false dependiendo de si es numerico o no
                return /\d/.test(String.fromCharCode(teclaPulsada));
            }else{
                return false;
            }
        }
    </script>

<div class="col-md-3">
                <p class="lead">Bestnid - Subastas</p>
                <!-- Boton para ofertar -->
                <div class="form-group"> <!-- -->
                    <label class="sr-only" for="exampleInputAmount">Marca</label> <!-- -->
                    <div class="input-group"> <!-- -->
                        <div class="input-group-addon"><i class="fa fa-times"></i></div> <!-- -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" >Ofertar</button>
                    </div> <!-- -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="exampleModalLabel">Nueva oferta</h4>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group">
                                            <label for="message-text" class="control-label">Necesidad:</label>
                                            <textarea class="form-control" style="resize:none;" id="message-text"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">$</div>
                                                <input type="text" onkeypress="return soloNumeros(event);" name="numero" class="form-control" id="exampleInputAmount" style="width:100px;" placeholder="Monto" maxlength="6">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-primary">Enviar oferta</button>
                                </div>
                            </div>
                        </div>
                    </div> <!-- -->
                </div>
            </div>