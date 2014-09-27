<?php
session_start();

$usuario = $_POST["usuario"];
$password = $_POST["contrasena"];

$host = "localhost"; 
$user = "root";
$pass = "";
$bbdd = "gestionHorarios"; 

$conexion_base_de_datos = mysql_connect($host,$user,$pass) or die("resultado1= ".urlencode(mysql_error())); 
mysql_select_db($bbdd,$conexion_base_de_datos) or die("resultado2= ".urlencode(mysql_error()));
$consultasql = "select * from usuarios where nombre='$usuario' and contrasena='$password'";

$retornoconsultasql = mysql_query($consultasql) or die ("resultado3= ".mysql_error());

if(mysql_num_rows($retornoconsultasql) == 1){
	
	$datos = mysql_fetch_array($retornoconsultasql);
	$_SESSION["rolusuario"] = $datos["rol"];

	if ($_SESSION["rolusuario"]== 1) {
		
		header("location:/final/admin.php");
	}
	else if ($_SESSION["rolusuario"]== 2) {
		header("location:/final/instructor.php");
	}
	else {
		header("location:index.php");
	}
	

}else{

	header("location:index.php?resp=datos_invalidos");
}

mysql_close($conexion_base_de_datos);

?>