<?php 
session_start();
if (empty($_SESSION["usuario"])) {
	header("refresh:0; ../index.php");
}
if (empty($_GET['folio'])){
	header("refresh:0; ventastotales.php");
}
$folio = $_GET['folio'];
include '../scripts/database.php';
$ventas=new Database();
$ventas->conectarBD();
$cadena = "SELECT v.folio ,concat(u.nombre,' ',u.apellidos) AS vendedor, concat(c.nombre,' ',c.apellidos) AS cliente, v.forma_pago, v.f_reg  FROM usuarios AS u INNER JOIN ventas AS v ON v.vendedor = u.id INNER JOIN clientes AS c ON c.id = v.cliente WHERE v.folio=$folio ORDER BY v.folio DESC";
$venta = $ventas->seleccionar2($cadena);

if ($venta==0){
	header("refresh:0; ventastotales.php");	
}
$folio = $venta['folio'];
$vendedor = $venta['vendedor'];
$cliente = $venta['cliente'];
$pago = $venta['forma_pago'];
$fecha = $venta['f_reg'];

$cadena = "SELECT vp.venta, p.folio, p.descripcion,vp.cantidad, vp.precio_u, round(vp.cantidad*vp.precio_u,2) as subtotal FROM venta_productos as vp INNER JOIN productos as p ON vp.producto = p.reg WHERE vp.venta = $folio";
$productos = $ventas->seleccionar($cadena);

$cadena = "SELECT round(sum(vp.cantidad*vp.precio_u),2) AS total FROM venta_productos as vp WHERE vp.venta = $folio";
$totales = $ventas->seleccionar2($cadena);
$total = $totales['total'];

?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Venta #<?php echo $folio; ?> </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/svg+xml" href="../favicon/moon-solid.svg" sizes="any">
    <meta http-equiv="x-ua-compatible" content="ie-edge">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/maina.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/forms.css">
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
		          <a class="dropdown-item" href="ventaa.php">Nueva Venta</a>
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
	<div class="container" style="margin-top: 40px;">
		<div class="row">
			<div class="col-md-8">
				<h2>Venta <span class="badge badge-success">#<?php echo $folio; ?></span></h2>
			</div>
			<div class="col-md-4">
				<a href="ventastotales.php" class="btn btn-danger" role="button" aria-pressed="true" style="width: 100%; margin.top: 5px; margin-bottom: 10px;"><i class="fas fa-angle-left"></i> Atras</a>
			</div>
		</div>
		<form action="../scripts/upduser.php" method="post" class="form col-md-6 col-12" style="padding-top: 30px;">
			<h3>Datos de la venta</h3>
			<input type="hidden" class="form-control" id="" name="folio" aria-describedby="emailHelp" placeholder="" value="<?php echo $folio; ?>" required>
			<div class="input-group mb-3">
			    <div class="input-group-prepend">
			      <span class="input-group-text">Vendedor </span>
			    </div>
		    	<input type="text" class="form-control" placeholder="" name="vendedor" value="<?php echo $vendedor; ?>" disabled>
		  	</div>
		  	<div class="input-group mb-3">
			    <div class="input-group-prepend">
			      <span class="input-group-text">Cliente </span>
			    </div>
		    	<input type="text" class="form-control" placeholder="" name="cliente" value="<?php echo $cliente; ?>" disabled>
		  	</div>
		  	<div class="input-group mb-3">
			    <div class="input-group-prepend">
			      <span class="input-group-text">Forma de pago </span>
			    </div>
		    	<input type="text" class="form-control" placeholder="" name="pago" value="<?php echo $pago; ?>" disabled>
		  	</div>
		  	<div class="input-group mb-3">
			    <div class="input-group-prepend">
			      <span class="input-group-text">Fecha </span>
			    </div>
		    	<input type="date" class="form-control" placeholder="" name="fecha" value="<?php echo $fecha; ?>" disabled>
		  	</div>
		  	<div class="input-group mb-3">
			    <div class="input-group-prepend">
			      <span class="input-group-text">Total $ </span>
			    </div>
		    	<input type="text" class="form-control" placeholder="" name="fecha" value="<?php echo $total; ?>" disabled>
		  	</div>
		</form>
	</div>
	<div class="container">
		<div class="row" style="margin-bottom: 20px">
			<div class="col-md-10 col-12"><h3>Productos</h3></div>
			<div class="col-md-2 col-12">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@fat" style="width: 100%">Agregar producto</button>
			</div>
		</div>
		<table class="table table-striped table-responsive-sm">
			<thead class="bg-info">
				<th scope="col">Folio</th>
				<th scope="col">Descripcion</th>
				<th scope="col">Cantidad</th>
				<th scope="col">Precio</th>
				<th scope="col">Subtotal</th>
			</thead>
			<tbody>
				<?php foreach($productos as $fila): ?>
					<tr>
						<th> <?php echo $fila->folio; ?> </th>
						<td> <?php echo $fila->descripcion; ?> </td>
						<td> <?php echo $fila->cantidad; ?> </td>
						<td> <?php echo $fila->precio_u; ?> </td>
						<td> <?php echo $fila->subtotal; ?> </td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
     <?php $ventas->desconectarBD(); ?>

<!-- ***************Footer                     ******************** -->
	<?php 
	$productoss=new Database();
	$productoss->conectarBD();
	$cadena = "SELECT * FROM productos";
	$productos = $productoss->seleccionar($cadena);
	 ?>
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Agregar producto a la venta #<?php echo $folio; ?></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form action="../scripts/addProextra.php" method="post" id="datos">
	        	<input type="hidden" class="form-control" id="" name="folio" aria-describedby="emailHelp" placeholder="" value="<?php echo $folio; ?>" required>
		          <div class="input-group mb-3">
				    <div class="input-group-prepend">
				      <span class="input-group-text">Producto </span>
				    </div>
			    	<select class="form-control" id="sel1" name="producto">
					     <?php foreach ($productos as $value): ?>
					     	<option value="<?php echo $value->reg; ?>"> <?php echo $value->folio ."  -$". $value->precio_venta; ?> </option>
					     <?php endforeach; ?>
					</select>
			  	</div>
			  	<div class="input-group mb-3">
				    <div class="input-group-prepend">
				      <span class="input-group-text">Cantidad </span>
				    </div>
				    <input type="number" class="form-control" id="" name="cantidad" aria-describedby="emailHelp" value="1" min="1" required>
			  	</div>
	        </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	        <button type="submit" class="btn btn-primary" form="datos">Registrar</button>
	      </div>
	    </div>
	  </div>
	</div>
	<?php $productoss->desconectarBD(); ?>    
<!-- ***************Footer                     ******************** -->
<!-- ***************Termino contenido del sitio******************** -->
   <!-- Enlazes a Jquery -->
    <script src="../js/popper.min.js"></script>
    <script src="../js/jquery-3.5.1.slim.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>