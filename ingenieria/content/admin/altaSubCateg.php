<div class="container-fluid">
    <div class="row">
        <div id="altaSubCategoria" class="col-sm-8 col-sm-offset-3">
            <div class="alert alert-info" role="alert">
                <strong>Agregar SubCategor&iacute;a</strong>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8 col-sm-offset-3">
            <form name="alta_subcateg_frm" action="procesarAltaSubCateg.php" method="post">
              <div class="form-group">
                <label for="subcategoriaAlta">Ingrese la subcategor&iacute;a a agregar:</label>
                <input type="text" class="form-control" id="subcategoriaAlta" name="altaSubCategoriaTxt" placeholder="Ingrese nombre de categor&iacute;a">
              </div>
              <div class="form-group">
                <select name="categoriaSeleccionada">
                    <option value="" size="auto">--Seleccione una categoria--</option>
                    <?php
                    include("selectCategoria.php");
                    ?>
                </select>
              </div>                  
              <div class="form-group">
                <input type="button" class="btn btn-default" value="Agregar" onclick="validarAgregarSubCateg()">
              </div>
            </form>
        </div>
    </div>
</div>