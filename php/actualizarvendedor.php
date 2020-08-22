<?php 
session_start();
if (empty($_SESSION["usuario"])) {
	header("refresh:0; ../index.php");
}
if (empty($_GET['id'])){
	header("refresh:0; verUsuarios.php");
}
$usuario = $_GET['id'];
include '../scripts/database.php';
$user=new Database();
$user->conectarBD();
$cadena = "SELECT*FROM usuarios WHERE id = '$usuario'";
$users = $user->seleccionar2($cadena);

if ($users==0){
	header("refresh:0; verUsuarios.php");	
}
$id = $users['id'];
$nombre = $users['nombre'];
$apellidos = $users['apellidos'];
$correo = $users['correo'];
$telefono = $users['telefono'];
$nacimiento = $users['fecha_nac'];
$domicilio = $users['domicilio'];
$tipo = $users['tipo_usuario'];
$pass = $users['pass'];

$cadena = "SELECT*FROM tipo_usuario WHERE id = '$tipo'";
$tipos = $user->seleccionar2($cadena);
$tip1 = $tipos['id'];
$tip2 = $tipos['Tipo'];
$opcion = '<option value="'.$tip1.'" selected>'.$tip2.'</option>';
$user->desconectarBD();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Usuario</title>
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
	<?php 
	$db=new Database();
	$db->conectarBD();
	$cadena = "select*from tipo_usuario";
	$registros = $db->seleccionar($cadena);
	 ?>
	<div class="container">
		<form action="../scripts/upduser.php" method="post" class="form col-md-6 col-11">
			<h2>Modificar Usuario #<?php echo $id; ?> </h2>
			<input type="hidden" class="form-control" id="" name="id" aria-describedby="emailHelp" placeholder="" maxlength="33" value="<?php echo $id; ?>" required>
			<div class="form-group">
				<input type="text" class="form-control" id="" name="nombre" aria-describedby="emailHelp" placeholder="Nombre del usuario" maxlength="33" value="<?php echo $nombre; ?>" required>
			</div>
			<div class="form-group">
				<input type="text" class="form-control" id="" name="apellidos" aria-describedby="emailHelp" placeholder="Apellidos del usuario" maxlength="55" value="<?php echo $apellidos; ?>" required>
			</div>
			<div class="form-group">
				<input type="email" class="form-control" id="" name="correo" aria-describedby="emailHelp" placeholder="Correo Electronico del usuario" maxlength="55" value="<?php echo $correo; ?>" required>
			</div>
			<div class="form-group">
				<input type="tel" class="form-control" id="" name="telefono" aria-describedby="emailHelp" placeholder="Telefono celular del usuario" maxlength="10" value="<?php echo $telefono; ?>" required>
			</div>
			<div class="input-group mb-3">
			    <div class="input-group-prepend">
			      <span class="input-group-text">Fecha de nacimiento</span>
			    </div>
		    	<input type="date" class="form-control" placeholder="" name="fnacimiento" value="<?php echo $nacimiento; ?>">
		  	</div>
			<div class="form-group">
				<input type="text" class="form-control" id="" name="domicilio" aria-describedby="emailHelp" placeholder="Domiciolio del usuario" maxlength="66" value="<?php echo $domicilio; ?>" required>
			</div>
			<div class="input-group mb-3">
			    <div class="input-group-prepend">
			      <span class="input-group-text">Tipo de usuario</span>
			    </div>
		    	<select class="form-control" id="sel1" name="tipo">
		    		<?php echo $opcion; ?>
				     <?php foreach ($registros as $value): ?>
				     	<option value="<?php echo $value->id; ?>"> <?php echo $value->Tipo; ?> </option>
				     <?php endforeach; ?>
				</select>
		  	</div>
		  	<a href="verUsuarios.php" class="btn btn-lg btn-danger" role="button" aria-pressed="true" style="width: 44%; margin-top: 10px;">Cancelar</a>
		  	<button type="submit" class="btn btn-lg btn-warning" style="width: 54%; margin-top: 10px;">Actualizar usuario</button>
		</form>
	</div>
     <?php $db->desconectarBD(); ?>
<!-- ***************Footer                     ******************** -->
<!-- ***************Termino contenido del sitio******************** -->
   <!-- Enlazes a Jquery -->
    <script src="../js/popper.min.js"></script>
    <script src="../js/jquery-3.5.1.slim.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>