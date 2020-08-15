<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar | MoonSystem</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie-edge">
    <link rel="icon" type="image/svg+xml" href="favicon/moon-solid.svg" sizes="any">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/maina.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
</head>
<body>
     <div class="container">
     	<form class="form col-md-4 col-11" action="scripts/checkUser.php" method="post">
     		<h1><i class="fas fa-moon logo" id="moon"><b class="logo">Moon System</b></i></h1>
     		<h3>Inicio de Secion</h3>
			<div class="form-group">
		    	<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Correo Electronico" name="correo">
		  	</div>
		  	<div class="form-group">
		    	<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña" name="contraseña">
		  	</div>
		  	<a href="#" class="badge badge-light">Olvide mi contraseña</a>
		  	<button type="submit" class="btn btn-primary">Iniciar Sesion</button>
		</form>
     </div>
         
<!-- ***************Termino contenido del sitio******************** -->
   <!-- Enlazes a Jquery -->
    <script src="js/popper.min.js"></script>
    <script src="js/jquery-3.5.1.slim.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>