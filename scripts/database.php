<?php 
class Database
{
	private $PDOLocal;
	private $user = "root";
	private $password = "";
	private $server ="mysql:host=localhost; dbname=ubuntu";
	function conectarBD()
	{
		try{
			$this->PDOLocal = new PDO($this->server,$this->user,$this->password);
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	function desconectarBD()
	{
		try{
			$this->PDOLocal= null;
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	function seleccionar($cadenaSQL)
	{
		try{
			$resultado = $this->PDOLocal->query($cadenaSQL);
			$renglon = $resultado->fetchAll(PDO::FETCH_OBJ);
			return $renglon;
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	function ejecutaSQL($cadenaSQL)
	{
		try {
			$this->PDOLocal->query($cadenaSQL);
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	function verificaLogin($correo,$contraseña)
	{
		try {
			$pase = 0;
			$tipo = 0;
			$query="SELECT*FROM usuarios WHERE correo='$correo'";
			$consulta = $this->PDOLocal->query($query);
			while ($registro = $consulta->fetch(PDO::FETCH_ASSOC))
			{
				if (password_verify($contraseña,$registro['contraseña']))
				{
					$pase=1;
					$tipo = $registro['tipo_usuario'];
				}
			}
			if ($pase==0) 
			{
				session_start();
				$_SESSION["usuario"]=$correo;
				echo "<div class='alert alert-success'>";
				echo "<h2 aling='center'>Bienvenido ".$_SESSION["usuario"]."</h2>";
				echo "</div>";
				if($tipo==1){
					header("refresh:1; ../maina.view.php");
				}
				else {
					header("refresh:1; ../mainv.view.php");
				}
			}
			else 
			{
				echo "<div class='alert alert-danger'>";
				echo "<h2 aling='center'>Usuario o Contraseña Incorrectos</h2>";
				echo "</div>";
				header("refresh:1; ../index.php");
			}
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	function cerrarSesion()
	{
		session_start();
		session_destroy();
		header("Location: ../index.php");
	}
}

 ?>