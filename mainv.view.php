<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Vendedor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/svg+xml" href="favicon/moon-solid.svg" sizes="any">
    <meta http-equiv="x-ua-compatible" content="ie-edge">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/mainv.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">

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
		        <a class="nav-link" href="#"><i class="fas fa-home menus"></i> Inicio<span class="sr-only">(current)</span></a>
		      </li>
		      <li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		          <i class="fas fa-shopping-cart menus"></i> Ventas
		        </a>
		        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
		          <a class="dropdown-item" href="#">Registros</a>
		          <a class="dropdown-item" href="#">Nueva venta</a>
		          <a class="dropdown-item" href="#">Consultas</a>
		        </div>
		      </li>
		      <li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		          Administracion
		        </a>
		        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
		          <a class="dropdown-item" href="#">Usuarios</a>
		          <a class="dropdown-item" href="#">Vendedores</a>
		          <a class="dropdown-item" href="#">Administradores</a>
		        </div>
		      </li>
		      <li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		          Reportes
		        </a>
		        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
		          <a class="dropdown-item" href="#">Reporte de ventas</a>
		          <a class="dropdown-item" href="#">Reporte de fletes</a>
		          <a class="dropdown-item" href="#">Ventas por articulo</a>
		        </div>
		      </li>
		      <li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		        	<i class="fas fa-envelope-open"></i>
		          <?php 
		          session_start();
		          if (isset($_SESSION["usuario"])) { echo $_SESSION["usuario"];}
		           ?>
		        </a>
		        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
		          <a class="dropdown-item" href="scripts/close.php">Cerrar Sesion</a></a>
		        </div>
		      </li>
		    </ul>
		  </div>
		  </div>
	</nav>
         
<!-- ***************Termino contenido del sitio******************** -->
   <!-- Enlazes a Jquery -->
    <script src="js/popper.min.js"></script>
    <script src="js/jquery-3.5.1.slim.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>