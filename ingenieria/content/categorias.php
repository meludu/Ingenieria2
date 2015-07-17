<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
session_start();


if (isset($_SESSION['estado']) && $_SESSION['estado'] == "online" && $_SESSION['tipo']=="admin") { // Para entrar aca hay que iniciar session


//errors
$errorEdit = 'vacio';
$errorAlta = 'vacio';
$errorBaja = 'vacio';

if (isset($_POST['errorAlta'])){
	//var_dump($_POST['errorAlta']);
	$errorAlta = $_POST['errorAlta'];
}
if (isset($_POST['errorEdit'])){
	//var_dump($_POST['errorEdit']);
	$errorEdit = $_POST['errorEdit'];
}
if (isset($_POST['errorBaja'])){
	$errorBaja = $_POST['errorBaja'];
}
// End handler errors

include("/../connect/conexion.php");

$query = "SELECT * FROM categorias ORDER BY nombre_cat";   // Consulta de las categorias
$res = mysqli_query($link, $query);
$cant = 1;
?>

<div id="page-content-wrapper">
    <div class="container-fluid">
    <a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><i class="fa fa-bars"></i></a>
		<div class="titulo"> 
			<span>Listado de categorias</span>
		</div>
		<div class="row">
			<div class="col-xs-9 col-xs-offset-2">
				<!-- Table -->
				<table class="table table-bordered">
				    <thead>
					    <tr>
						    <th></th>
					        <th>Categor&iacute;a</th>
					        <th>Eliminar</th>
					        <th>Modificar</th>
					    </tr>
				    </thead>
				    <?php
		            while ($listar = mysqli_fetch_array($res)){
		            ?>
				    <tbody>
				        <tr class="active">
					        <th scope="row"><?php echo $cant++; ?></th>
					        <td>
					        <?php
					        echo utf8_encode($listar["nombre_cat"]);
					        ?></td>
					        <td>
					        <?php
					        $categ_id = $listar["idCategoria"];
					        ?>
					        <a type='button' id='bajaCat_<?php echo $categ_id;?>' class='btn btn-primary bajaCategClass' data-toggle='modal' data-target='.bs-example-modal-sm'><i class='fa fa-trash-o'></i></a>
					        <?php
			                //echo "<a href='#' onclick='confirmDelCateg($categ_id)'><i class='fa fa-trash-o'></i></a>";
			                ?>
			                <!--<a type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">Small modal</a>-->
					        </td>
					        <td>
					        <a type="button" class="editCategClass" id='editCat_<?php echo $categ_id;?>'><i class='fa fa-pencil'></i></a>
			                <!--echo "<a id='editCat' href='?siteMap=categorias&eleccion=editCateg&idCategoria=".$listar["idCategoria"]."'><i class='fa fa-pencil'></i></a>";-->
					        </td>
				        </tr>
				    <?php
				  	}
				  	?>
				    </tbody>
				</table>

				<!-- Error Add categ-->
				<div id="successAddCateg" class="col-xs-9 col-xs-offset-2 hidden margin-top-20">
			  		<div class="alert alert-success" role="alert">
			      		<strong>&Eacute;xito!</strong>, se agreg&oacute; la categor&iacute;a
			    	</div>	  	    	
				</div><!-- Success Add categ-->
				<div id="errorAddCateg" class="col-xs-9 col-xs-offset-2 hidden margin-top-20">
				  	<div class="alert alert-danger" role="alert">
				    	<strong>Error</strong>, la categor&iacute;a ya existe
				    </div>	  	    	
				</div><!-- Error Add categ-->
				
				<!-- Error Edit categ-->
				<div id="successModifCateg" class="col-xs-9 col-xs-offset-2 hidden margin-top-20">
			  		<div class="alert alert-success" role="alert">
			      		<strong>&Eacute;xito!</strong>, se modific&oacute; correctamente la categor&iacute;a
			    	</div>	  	    	
				</div><!-- Success edit categ-->
				<div id="errorModifCateg" class="col-xs-9 col-xs-offset-2 hidden margin-top-20">
				  	<div class="alert alert-danger" role="alert">
				    	<strong>Error</strong>, escriba una categor&iacute;a, y que sea v&aacute;lida
				    </div>	  	    	
				</div><!-- FIN Error Edit categ-->

				<!-- Error Baja categ-->
				<div id="successBajaCateg" class="col-xs-9 col-xs-offset-2 hidden margin-top-20">
			  		<div class="alert alert-success" role="alert">
			      		<strong>&Eacute;xito!</strong>, se elimin&oacute; correctamente la categor&iacute;a
			    	</div>	  	    	
				</div><!-- Success baja categ-->
				<div id="errorBajaCateg" class="col-xs-9 col-xs-offset-2 hidden margin-top-20">
				  	<div class="alert alert-danger" role="alert">
				    	<strong>Error</strong>, no se pudo dar de baja la categor&iacute;a
				    </div>	  	    	
				</div><!-- FIN Error Baja categ-->	
			
			    <!-- MANEJO DE ALTA-->
			    <?php
			    if ($errorAlta === 'false'){
			    ?>
				<script>
					$('#successAddCateg').removeClass('hidden');
				</script>
				<?php	
				}
				elseif ($errorAlta === 'true'){
					?>
					<script>
						$('#errorAddCateg').removeClass('hidden');
					</script>
				<?php
				}
				?>
				<!-- END manejo de alta-->
				
				<!-- MANEJO DE MODIFICACIÓN-->
			    <?php
			    if ($errorEdit === 'true'){
			    ?>
				<script>
					$('#successModifCateg').removeClass('hidden');
				</script>
				<?php	
				}
				elseif ($errorEdit === 'false'){
					?>
					<script>
						$('#errorModifCateg').removeClass('hidden');
					</script>
				<?php
				}
				?>
				<!-- END MANEJO MODIFICACIÓN-->

				<!-- MANEJO DE BAJA-->
			    <?php
			    if ($errorBaja === 'true'){
			    ?>
				<script>
					$('#successBajaCateg').removeClass('hidden');
				</script>
				<?php	
				}
				elseif ($errorBaja === 'false'){
					?>
					<script>
						$('#errorBajaCateg').removeClass('hidden');
					</script>
				<?php
				}
				?>
				<!-- END MANEJO BAJA-->
			    <br>
			    <div class="margin-bottom-50">
			   
			    <button type="button" id="addCat" class="btn btn-primary">Agregar nueva categor&iacute;a</button>
			  
			    </div>
			</div>
		</div>	
	</div>
	<!-- FORM DE ALTA-->
	<div id="addCategForm" class="container-fluid hidden">
			<div class="row">
		        <div id="altaCategoria" class="col-sm-8 col-sm-offset-3">
		            <div class="alert alert-info" role="alert">
		                <strong>Agregar Categor&iacute;a</strong>
		            </div>
		        </div>
    		</div>
    		<div class="row">
		        <div class="col-sm-8 col-sm-offset-3">
		            <form name="alta_categ_frm" action="procesarAltaCateg.php" method="post" data-parsley-validate>
		              <div class="form-group">
		                <label for="categoriaAlta">Ingrese la categor&iacute;a a agregar:</label>
		                <input type="text" class="form-control" id="categoriaAlta" name="altaCategoriaTxt" data-parsley-trigger="change" data-parsley-validate-if-empty placeholder="Ingrese nombre de categor&iacute;a" required>
		              </div>
		              <div class="form-group">
		                <input type="submit" class="btn btn-default" value="Agregar" >
		                <input type="reset" class="btn btn-danger" value="Limpiar">
		              </div>
		            </form>
		        </div>
    		</div>
	</div>
	<!-- FORM DE MODIFICACIÓN-->
	<!-- script para traerme el id-->
	<script>
		$(".editCategClass").click(function() {
			var values = $(this).attr('id').split("_"),
				idC = parseInt(values[1]);
			$.post('getIdCategForEdit.php',{idCategoria:idC},function(response){
				$('#contentEditForm').html(response);
				$('#categoriaEdit').focus();
			});
		});
		$(".bajaCategClass").click(function() {
			var values = $(this).attr('id').split("_"),
				idC = parseInt(values[1]);
				console.log(idC);
			$.post('getIdCategForDelete.php',{idCategoria:idC},function(response){
				var $data = $(response);
				$('#headerModalMsj').html($data.filter('#one'));
				$('#buttonModalLink').html($data.filter('#two'));
			});
		});

	</script>
	<!-- DELETE-->
	<!-- BEGIN MODAL-->
	<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	  <div class="modal-dialog modal-sm">
	    <div class="modal-content">
	    	<div class="modal-header">
	    		<div id="headerModalMsj"></div>
	    	</div>
		    <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
		  		<a id="buttonModalLink"></a>
		    </div>
	    </div>
	  </div>
	</div>
	<!-- END MODAL-->

	<!-- Form -->
	<?php
	?>
	<div id="modifCategForm" class="container-fluid hidden">
	    <div class="row">
	        <div id="editarCategoria" class="col-sm-8 col-sm-offset-3">
	            <div class="alert alert-info" role="alert">
	                <strong>Editar Categor&iacute;a</strong>
	            </div>
	        </div>
	    </div>
	    <div class="row">
	    	<!-- Acá se guarda el Formulario para editar una categoría-->
	        <div id="contentEditForm" class="col-sm-8 col-sm-offset-3">
	        </div>
	    </div>
	</div>
	<!-- SCRIPTS DE ALTA, BAJA Y MODIFICACION-->
</div>

<?php
}else{
	?>
	<div class="alert alert-danger" role="alert">
      <strong>Error!</strong>. Ha ocurrido un error al tratar de ingresar a esta pagina.
    </div>
<?php
}
?>
