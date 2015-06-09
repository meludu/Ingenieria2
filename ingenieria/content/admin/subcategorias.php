<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
session_start();

if ($_SESSION['estado'] == "online") { // Para entrar aca hay que iniciar session
$eleccion=$_GET["eleccion"];
        switch ($eleccion){
            case "altaSubCateg":  
                $contenedor = "altaSubCateg.php";
                break;
            case "bajaSubCateg": 
                $contenedor = "procesarBajaSubCateg.php";
                break;
            case "editSubCateg": 
                $contenedor = "editarSubCateg.php";
                break;
    };

	include("/../../connect/conexion.php");

  	$query = "SELECT * FROM subcategorias ORDER BY nombre";
  	$res = mysqli_query($link, $query);
  	$cant = 1;
?>
<div id="page-content-wrapper">
    <div class="container-fluid">
    	<a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><i class="fa fa-bars"></i></a>
		<div class="titulo"> 
			<span>Listado de subcategorias</span>
		</div>
		<div class="row">
			<div class="col-xs-9 col-xs-offset-2">
				  <!-- Table -->
				  <table class="table table-bordered">
				    <thead>
				      <tr>
				        <th></th>
				        <th>SubCategor&iacute;a</th>
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
				        echo utf8_encode($listar["nombre"]);
				        ?></td>
				        <td>
				        <?php
				        $subcateg_id = $listar["idSubCategoria"];
		                echo "<a href='#' onclick='confirmDelSubCateg($subcateg_id)'><i class='fa fa-trash-o'></i></a>";
		                ?>
				        </td>
				        <td>
				        <?php 
		                echo "<a href='?siteMap=subcategorias&eleccion=editSubCateg&idSubCategoria=".$listar["idSubCategoria"]."'><i class='fa fa-pencil'></i></a>";
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
				  	<a class="btn btn-primary" href='?siteMap=subcategorias&eleccion=altaSubCateg'>Agregar nueva subcategor&iacute;a</a>
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