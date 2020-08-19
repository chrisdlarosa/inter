<?php 
include 'database.php';
$db=new Database();
$db->conectarBD();
extract($_POST);
$db->verificaLogin("$correo","$pass");
$db->desconectarBD();
 ?>