<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
session_start();

if ($_SESSION['estado'] == "online") { // Para entrar aca hay que iniciar session
	

$eleccion=$_GET["eleccion"];
        switch ($eleccion){
            case "altaCateg":  
                $contenedor = "altaCateg.php";
                break;
            case "bajaCateg": 
                $contenedor = "procesarBajaCateg.php";
                break;
            case "editCateg": 
                $contenedor = "editarCateg.php";
                break;
    };

    include("/../../connect/conexion.php");
    
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
		                echo "<a href='#' onclick='confirmDelCateg($categ_id)'><i class='fa fa-trash-o'></i></a>";
		                ?>
				        </td>
				        <td>
				        <?php 
		                echo "<a href='?siteMap=categorias&eleccion=editCateg&idCategoria=".$listar["idCategoria"]."'><i class='fa fa-pencil'></i></a>";
		                ?>
				        </td>
				      </tr>
				      <?php
				  	  }
				  	  ?>
				    </tbody>
				  </table>
				  <br>
				  <div class="margin-bottom-50">
				  	<a class="btn btn-primary" href='?siteMap=categorias&eleccion=altaCateg'>Agregar nueva categor&iacute;a</a>
				  </div>
			</div>
		</div>	
	</div>
	<?php
        include ($contenedor);
    ?>
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
