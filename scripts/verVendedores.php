<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ver Vendedores</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie-edge">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" href="..//css/vervendedores.css">
</head>
<body>
	<div class="container" id="contenido">
		<h2>Ver vendedores</h2>
		<?php 
		include 'database.php';
		$conexion = new Database();
		$conexion->conectarBD();
		$consulta="SELECT*FROM usuarios";
		$tabla = $conexion->seleccionar($consulta);
		 ?>
		<table class="table table-hover table-sm table-bordered table-responsive-sm">
			<thead class="table-primary">
				<th scope="col">ID</th>
				<th scope="col">NOMBRE</th>
				<th scope="col">CORREO</th>
				<th scope="col">TELEFONO</th>
				<th scope="col">NACIMIENTO</th>
				<th scope="col">DOMICILIO</th>
				<th scope="col">TIPO</th>
			</thead>
			<tbody>
				<?php foreach($tabla as $fila): ?>
					<tr>
						<td> <?php echo $fila->id; ?> </td>
						<td> <?php echo $fila->nombre ." ". $fila->apellidos; ?> </td>
						<th> <?php echo $fila->correo; ?> </th>
						<td> <?php echo $fila->telefono; ?> </td>
						<td> <?php echo $fila->fecha_nac; ?> </td>
						<td> <?php echo $fila->domicilio; ?> </td>
						<td> <?php echo $fila->tipo_usuario; ?> </td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>


	<script src="../js/popper.min.js"></script>
    <script src="../js/jquery-3.5.1.slim.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>