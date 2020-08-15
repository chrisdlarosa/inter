<?php 
include 'database.php';
$db=new Database();
$db->conectarBD();
extract($_POST);
$db->verificaLogin("$correo","$contraseña");
$db->desconectarBD();
 ?>