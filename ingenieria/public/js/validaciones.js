//Funciones para las categorias

//Confirmar Baja de categoria
function confirmDelCateg(id){
    var agree = confirm("¿Realmente desea eliminarla?");
    if (agree){
        location.href='?siteMap=categorias&eleccion=bajaCateg&idCategoria='+id;
    }
}
//editar categoria
function validarModificarCateg(){
    var verificar = true;
    //que no sea blanco
    if (!document.modif_categ_frm.editarCategoriaTxt.value){
        alert("Es necesario que edite la categoría");
        document.modif_categ_frm.editarCategoriaTxt.focus();
        verificar = false;
    }
    if (verificar == true){
        document.modif_categ_frm.submit();
    }
}

//agregar categoria
function validarAgregarCateg() {
	var verificar = true;
    //que no sea blanco
    if (!document.alta_categ_frm.altaCategoriaTxt.value) { 		
        alert("Es necesario que escriba la categoría a agregar");
        document.alta_categ_frm.altaCategoriaTxt.focus();
        verificar = false;
    }
    if (verificar == true){
        document.alta_categ_frm.submit();
    }
}

//Funciones para las subcategorias
//agregar subcategoria
function validarAgregarSubCateg() {
	var verificar = true;
    //que no sea blanco
    if (!document.alta_subcateg_frm.altaSubCategoriaTxt.value) { 		
        alert("Es necesario que escriba la subcategoria a agregar");
        document.alta_subcateg_frm.altaSubCategoriaTxt.focus();
        verificar = false;
    }
    if (!document.alta_subcateg_frm.categoriaSeleccionada.value) {
        alert("Es necesario que elija una categoría");
        document.alta_subcateg_frm.categoriaSeleccionada.focus();
        verificar = false;
    }
    if (verificar == true){
        document.alta_subcateg_frm.submit();
    }
}

function validarModificarSubCateg(){
    var verificar = true;
    //que no sea blanco
    if (!document.edit_subcateg_frm.editSubCategoriaTxt.value){
        alert("Es necesario que edite la subcategoría");
        document.edit_subcateg_frm.editSubCategoriaTxt.focus();
        verificar = false;
    }
     if (!document.edit_subcateg_frm.editCategoriaSelect.value){
        alert("Es necesario que elija una categoría");
        document.edit_subcateg_frm.editCategoriaSelect.focus();
        verificar = false;
     }
    if (verificar == true){
        document.edit_subcateg_frm.submit();
    }
}

function confirmDelSubCateg(id){
    var agree = confirm("¿Realmente desea eliminarla?");
    if (agree){
        location.href='?siteMap=subcategorias&eleccion=bajaSubCateg&idSubCategoria='+id;
    }
}

//