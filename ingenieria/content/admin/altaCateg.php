
<div class="container-fluid">
    <div class="row">
        <div id="altaCategoria" class="col-sm-8 col-sm-offset-3">
            <div class="alert alert-info" role="alert">
                <strong>Agregar Categor&iacute;a</strong>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8 col-sm-offset-3">
            <form name="alta_categ_frm" action="procesarAltaCateg.php" method="post">
              <div class="form-group">
                <label for="categoriaAlta">Ingrese la categor&iacute;a a agregar:</label>
                <input type="text" class="form-control" id="categoriaAlta" name="altaCategoriaTxt" placeholder="Ingrese nombre de categor&iacute;a">
              </div>
              <div class="form-group">
                <input type="button" class="btn btn-default" value="Agregar" onclick="validarAgregarCateg()">
              </div>
            </form>
        </div>
    </div>
</div>