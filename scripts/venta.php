<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Realizando venta</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie-edge">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/maina.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/forms.css">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
	<style>
		.container {margin-top: 70px}
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
		      <li class="nav-item">
		        <a class="nav-link" href="#"><i class="fas fa-home menus"></i> Inicio<span class="sr-only">(current)</span></a>
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
		          <a class="dropdown-item" href="#">Ver Productos</a>
		          <a class="dropdown-item" href="#">Agregar Poductos</a>
		          <a class="dropdown-item" href="#">Consultas</a>
		        </div>
		      </li>
		      <li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		          <i class="fas fa-user-tie"></i> Vendedores
		        </a>
		        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
		          <a class="dropdown-item" href="#">Ver Vendedores</a>
		          <a class="dropdown-item" href="#">Agregar Vendedor</a>
		          <a class="dropdown-item" href="#">Consultas</a>
		        </div>
		      </li>
		    </ul>
		  </div>
		  </div>
	</nav>
<!-- ***************Inicio del sitio******************* -->
	<div class="container">
		<?php 
		extract($_POST);
		session_start();
		$ide = $_SESSION['vendedor'];
		include 'database.php';
		$db=new Database();
		$db->conectarBD();
		$cadena = "INSERT INTO ventas (vendedor,cliente,f_reg,forma_pago) VALUES ($ide,$cliente,now(),'$pago')";
		$db->ejecutaSQL($cadena);
		$db->desconectarBD();

		$db2=new Database();
		$db2->conectarBD();
		$cadena = "SELECT*FROM ventas order by folio DESC LIMIT 1";
		$lastventa = $db2->seleccionar2($cadena);
		$last = $lastventa['folio'];
		$db2->desconectarBD();

		$db3=new Database();
		$db3->conectarBD();
		$cadena = "SELECT*FROM productos WHERE reg = '$producto'";
		$productos = $db3->seleccionar2($cadena);
		$precio = $productos['precio_venta'];
		$iva = $productos['iva'];
		$iva = $precio*($iva/100);
		$total = $precio+$iva;
		$db3->desconectarBD();

		$db4=new Database();
		$db4->conectarBD();
		$cadena = "INSERT INTO venta_productos (venta,producto,precio_u,cantidad) VALUES ($last,$producto,$total,$cantidad)";
		$db4->ejecutaSQL($cadena);
		$db4->desconectarBD();
		 ?>

		 <div class="alert alert-success">Venta registrada con el folio #<?php echo $last; ?> </div>
		<?php 
		header("refresh:3; ../php/ventaa.php");
		 ?>
	</div>
<!-- ***************Termino contenido del sitio******************** -->
   <!-- Enlazes a Jquery -->
    <script src="../js/popper.min.js"></script>
    <script src="../js/jquery-3.5.1.slim.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>