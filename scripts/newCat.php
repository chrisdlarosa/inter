<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregando Usuario</title>
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
<!-- ***************Inicio del sitio******************* -->
	<div class="container">
		<?php
		include 'database.php';
		$db=new Database();
		$db->conectarBD();
		extract($_POST);
		$codigo = strtoupper($codigo);
		$descripcion = strtoupper($descripcion);
		$cadena="INSERT INTO categorias (codigo, Nombre) VALUES ('$codigo', '$descripcion')";
		$db->ejecutaSQL($cadena);
		?>
		<div class="alert alert-success">Categoria agregado exitosamente!</div>
		<?php 
		header("refresh:3; ../php/categorias.php");
		 ?>
	</div>
<!-- ***************Termino contenido del sitio******************** -->
   <!-- Enlazes a Jquery -->
    <script src="../js/popper.min.js"></script>
    <script src="../js/jquery-3.5.1.slim.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>