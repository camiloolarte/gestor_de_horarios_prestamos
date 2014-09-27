<?php
session_start();
if($_SESSION["rolusuario"] != 1){
	header("location:index.php?resp=noAdmin");
}else{
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Gestion de Horarios</title>
		<link rel="stylesheet" href="estilos.css">

		<style type="text/css"> 

		</style> 

	</head>
	<body>
		<h1>Inicio Administrador</h1>
		<table id="links">
			<tr>
				<td><a href="admin.php">inicio</a></td>
			</tr>
			<tr>
				<td><a href="gestion_institucion.php">gestion institucion</a></td>
			</tr>
			<tr>
				<td><a href="gestion_sede.php">gestion sedes</a> </td>
			</tr>
			<tr>
				<td><a href="gestion_ambiente.php">gestion ambiente</a></td>
			</tr>
			<tr>
				<td><a href="inventario_ambiente.php">gestion inventario</a></td>
			</tr>
			<tr>
				<td><a href="gestion_grupo.php">gestion grupo</a></td>
			</tr>
			<tr>	
				<td><a href="gestion_instructor.php">gestion instructor</a></td>
			</tr>
			<tr>	
				<td><a href="prestamo_inventario.php">prestamos de inventario</a></td>
			</tr>
			<tr>
				<td><a href="reserva_ambientes.php">reservar ambiente</a></td>
			</tr>
			<tr>
				<td><a href="cerrar.php">cerrar sesion</a></td>
			</tr>
		</table>
	</body>
</html>
<?php
	}
?>