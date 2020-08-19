<?php 
session_start();
if (empty($_SESSION["usuario"])) {
	header("refresh:0; ../index.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos por Categoria</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/svg+xml" href="favicon/moon-solid.svg" sizes="any">
    <meta http-equiv="x-ua-compatible" content="ie-edge">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/maina.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/categorias.css">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
	<style>
		form {margin-bottom: 50px}
	</style>
</head>
<body>
     <nav class="navbar navbar-expand-lg navbar-light sticky-top">
     	<div class="container">
		  <a class="navbar-brand" href="#"><i class="fas fa-moon logo" id="moon"><b class="logo">Moon System</b></i></a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarNavDropdown">
		    <ul class="navbar-nav ml-auto">
		      <li class="nav-item active">
		        <a class="nav-link" href="../maina.view.php"><i class="fas fa-home menus"></i> Inicio<span class="sr-only">(current)</span></a>
		      </li>
		      <li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		          <i class="fas fa-shopping-cart menus"></i> Ventas
		        </a>
		        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
		          <a class="dropdown-item" href="#">Registros</a>
		          <a class="dropdown-item" href="#">Nueva Venta</a>
		          <a class="dropdown-item" href="#">Consultas</a>
		        </div>
		      </li>
		      <li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		          <i class="fas fa-address-card"></i> Clientes
		        </a>
		        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
		          <a class="dropdown-item" href="#">Ver Clientes</a>
		          <a class="dropdown-item" href="#">Agregar Cliente</a>
		          <a class="dropdown-item" href="#">Consultas</a>
		        </div>
		      </li>
		      <li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		          <i class="fas fa-box-open"></i> Productos
		        </a>
		        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
		          <a class="dropdown-item" href="productos.php">Ver Productos</a>
		          <a class="dropdown-item" href="nuevoProducto.php">Agregar Poductos</a>
		          <a class="dropdown-item" href="categorias.php">Categorias</a>
		          <a class="dropdown-item" href="productosxcategoria.php">Productos por Categoria</a>
		          <a class="dropdown-item" href="#">Consultas</a>
		        </div>
		      </li>
		      <li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		          <i class="fas fa-user-tie"></i> Usuarios
		        </a>
		        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
		          <a class="dropdown-item" href="verUsuarios.php">Ver Usuarios</a>
		          <a class="dropdown-item" href="nuevoVendedeor.php">Agregar Usuarior</a>
		          <a class="dropdown-item" href="#">Consultas</a>
		        </div>
		      </li>
		      <li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		        	<i class="fas fa-envelope-open"></i>
		          <?php 
		          echo $_SESSION["usuario"];
		          ?>
		        </a>
		        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
		          <a class="dropdown-item" href="../scripts/close.php">Cerrar Sesion</a></a>
		        </div>
		      </li>
		    </ul>
		  </div>
		  </div>
	</nav>

<!-- ***************Inicio del sitio******************* -->
<?php 
		include '../scripts/database.php';
		$db = new Database();
		$db->conectarBD();
		$consulta="SELECT*FROM categorias";
		$tabla = $db->seleccionar($consulta);
		 ?>
	<div class="container" id="cat">
		<div class="row" style="margin-bottom: 20px">
			<div class="col-md-5 col-12">
				<h2>Productos por Categoria</h2>
			</div>
			<div class="col-md-7 col-12">
				<form class="form" action="#" method="get">
					<div class="input-group mb-3">
					    <div class="input-group-prepend">
					      <span class="input-group-text">Categoria </span>
					    </div>
				    	<select class="form-control" id="sel1" name="categoria">
						     <?php foreach ($tabla as $value): ?>
						     	<option value="<?php echo $value->cve; ?>"> <?php echo $value->Nombre; ?> </option>
						     <?php endforeach; ?>
						</select>
						<div class="input-group-append">
						    <button class="btn btn-primary" type="input"> Buscar por categoria </button>
						  </div> 
				  	</div>
				</form>
				<?php $db->desconectarBD(); ?>
			</div>
		</div>
		<?php if($_GET):
			extract($_GET);
			$conexion = new Database();
			$conexion->conectarBD();
			$consulta="SELECT*FROM productos WHERE categoria = $categoria";
			$tabla = $conexion->seleccionar($consulta);
			?>
		 <table class="table table-hover table-responsive-sm">
			<thead class="bg-primary">
				<th scope="col">Folio</th>
				<th scope="col">Descripcion</th>
				<th scope="col">Costo</th>
				<th scope="col">Precio</th>
				<th scope="col">IVA</th>
				<th scope="col">Registrado</th>
				<th scope="col">Categoria</th>
			</thead>
			<tbody>
				<?php foreach($tabla as $fila): ?>
					<tr>
						<th> <?php echo $fila->folio; ?> </td>
						<td> <?php echo $fila->descripcion; ?> </td>
						<td> <?php echo $fila->costo; ?> </td>
						<td> <?php echo $fila->precio_venta; ?> </td>
						<td> <?php echo $fila->iva; ?> </td>
						<td> <?php echo $fila->f_reg; ?> </td>
						<td> <?php echo $fila->categoria; ?> </td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php endif; 
	?>
	</div>

<!-- ***************Termino contenido del sitio******************** -->
   <!-- Enlazes a Jquery -->
    <script src="../js/popper.min.js"></script>
    <script src="../js/jquery-3.5.1.slim.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>