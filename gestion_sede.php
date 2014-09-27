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
		<h1>Gestion de Sedes</h1>
		<table id="links" >
			<tr>
				<td><a href="admin.php">inicio</a></td>
			</tr>
			<tr>
				<td><a href="gestion_institucion.php">gestion institucion</a></td>
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

		<table id="for1">
			<form action="gestion_sede.php" method="post" >
				<tr>
					<td></td>
					<td><h4>solicitar formulario de:</h4></td>
				</tr>
				<tr>			    	
			    	<td> <input type="radio" name="decide" value="resgistrar" /></td>
			    	<td>registrar</td>
			    </tr>
			    <tr>
			    	
			    	<td><input type="radio" name="decide" value="editar" /></td>
			    	<td>editar</td>
			    </tr>
			    <tr>
			    	
			    	<td><input type="radio" name="decide" value="eliminar" /></td>
			    	<td>eliminar</td>
			    </tr>
			    <tr> 
					<td></td>
			    	<td><input type="submit" name="submit1" value="Solicitar" /></td>
			    </tr>
			</form>
		</table> 
		

						
		<?php

			
			function ejecutar1(){

				$decide=$_POST["decide"];
				
				if ($decide == "resgistrar") {

					$host = "localhost"; 
					$user = "root";
					$pass = "";
					$bbdd = "gestionHorarios";

					$conexion_base_de_datos = mysql_connect($host,$user,$pass) or die("resultado1= ".urlencode(mysql_error())); 
					mysql_select_db($bbdd,$conexion_base_de_datos) or die("resultado2= ".urlencode(mysql_error()));
					$consultasql = "select * from instituciones";
					$retornoconsultasql = mysql_query($consultasql) or die ("resultado3= ".mysql_error());
					echo "<table id='resultado'>";  
						echo "<tr id='titulos'>";  
						echo "<th>-id institucion-</th>";  
						echo "<th>-nombre-</th>";  
						echo "<th>-correo-</th>"; 
						echo "<th>-telefono-</th>"; 
						echo "<th>-dirreccion-</th>";  
										
						echo "</tr>";  
						while ($recorre = mysql_fetch_row($retornoconsultasql)){   
						    echo "<tr id='datos'>";  
						    echo "<td>$recorre[0]</td>";  
						    echo "<td>$recorre[1]</td>";  
						    echo "<td>$recorre[2]</td>"; 
						    echo "<td>$recorre[3]</td>";
						    echo "<td>$recorre[4]</td>";
						    				    
						    echo "</tr>";  
						}  
						echo "</table>";

					echo '<form action="gestion_sede.php" method="post" id="for2" >

						    nombre: <input type="text" name="nombre"><br />
						    correo: <input type="text" name="correo"><br />
						    telefono: <input type="number" name="telefono"><br />
						    direccion: <input type="text" name="direccion"><br />
						    ciudad: <input type="text" name="ciudad"><br />
						    id_institucion: <input type="text" name="id_institucion"><br />

						    <input type="submit" name="registrar" value="Registrar" />
						</form>';
				} elseif ($decide == "editar") {

					$host = "localhost"; 
					$user = "root";
					$pass = "";
					$bbdd = "gestionHorarios";

					$conexion_base_de_datos = mysql_connect($host,$user,$pass) or die("resultado1= ".urlencode(mysql_error())); 
					mysql_select_db($bbdd,$conexion_base_de_datos) or die("resultado2= ".urlencode(mysql_error()));
					$consultasql = "select
									sedes.id,sedes.nombre,sedes.correo,sedes.telefono,sedes.direccion,sedes.ciudad,
									instituciones.nombre,instituciones.id
									from sedes
									inner join instituciones
									on sedes.id_institucion = instituciones.id
									";
					$retornoconsultasql = mysql_query($consultasql) or die ("resultado3= ".mysql_error());
					
					echo "<table id='resultado'>";  
						echo "<tr id='titulos'>";  
						echo "<th>-id-</th>";  
						echo "<th>-nombre-</th>";  
						echo "<th>-correo-</th>"; 
						echo "<th>-telefono-</th>"; 
						echo "<th>-direccion-</th>";  
						echo "<th>-ciudad-</th>"; 
						echo "<th>-institucion-</th>";
						echo "<th>-institucion id-</th>";  
										
						echo "</tr>";  
						while ($recorre = mysql_fetch_row($retornoconsultasql)){   
						    echo "<tr id='datos'>";  
						    echo "<td>$recorre[0]</td>";  
						    echo "<td>$recorre[1]</td>";  
						    echo "<td>$recorre[2]</td>"; 
						    echo "<td>$recorre[3]</td>";
						    echo "<td>$recorre[4]</td>";
						    echo "<td>$recorre[5]</td>";
						    echo "<td>$recorre[6]</td>";
						    echo "<td>$recorre[7]</td>";
						    
						    				    
						    echo "</tr>";  
						}  
						echo "</table>";  

					mysql_close($conexion_base_de_datos);

					echo '<form action="gestion_sede.php" method="post" id="for2">
							id: <input type="number" name="id"><br />
							nombre: <input type="text" name="nombre"><br />
						    correo: <input type="text" name="correo"><br />
						    telefono: <input type="number" name="telefono"><br />
						    direccion: <input type="text" name="direccion"><br />
						    ciudad: <input type="text" name="ciudad"><br />
						    id_institucion: <input type="text" name="id_institucion"><br />
						     						    		   
						    <input type="submit" name="editar" value="Editar" />
						</form>';
				}elseif ($decide == "eliminar") {
					$host = "localhost"; 
					$user = "root";
					$pass = "";
					$bbdd = "gestionHorarios";

					$conexion_base_de_datos = mysql_connect($host,$user,$pass) or die("resultado1= ".urlencode(mysql_error())); 
					mysql_select_db($bbdd,$conexion_base_de_datos) or die("resultado2= ".urlencode(mysql_error()));
					$consultasql = "select
									sedes.id,sedes.nombre,sedes.correo,sedes.telefono,sedes.direccion,sedes.ciudad,
									instituciones.nombre,instituciones.id
									from sedes
									inner join instituciones
									on sedes.id_institucion = instituciones.id
									";
					$retornoconsultasql = mysql_query($consultasql) or die ("resultado3= ".mysql_error());
					
					echo "<table id='resultado'>";  
						echo "<tr id='titulos'>";  
						echo "<th>-id-</th>";  
						echo "<th>-nombre-</th>";  
						echo "<th>-correo-</th>"; 
						echo "<th>-telefono-</th>"; 
						echo "<th>-direccion-</th>";  
						echo "<th>-ciudad-</th>"; 
						echo "<th>-institucion-</th>";
						echo "<th>-institucion id-</th>";  
										
						echo "</tr>";  
						while ($recorre = mysql_fetch_row($retornoconsultasql)){   
						    echo "<tr id='datos'>";  
						    echo "<td>$recorre[0]</td>";  
						    echo "<td>$recorre[1]</td>";  
						    echo "<td>$recorre[2]</td>"; 
						    echo "<td>$recorre[3]</td>";
						    echo "<td>$recorre[4]</td>";
						    echo "<td>$recorre[5]</td>";
						    echo "<td>$recorre[6]</td>";
						    echo "<td>$recorre[7]</td>";
						    
						    				    
						    echo "</tr>";  
						}  
						echo "</table>"; 

					mysql_close($conexion_base_de_datos);

					echo '<form action="gestion_sede.php" method="post" id="for2">
					
							id: <input type="number" name="id"><br />
						    						     						    		   
						    <input type="submit" name="eliminar" value="Eliminar" />
						</form>
					';
				}
			}

							

			 if(isset($_POST['submit1']))
			{
			    ejecutar1();
			}

			
//--------------------------- funcion registrar

			
			function ejecutar2()
			{
				$nombre=$_POST["nombre"];
				$correo=$_POST["correo"];
				$telefono=$_POST["telefono"];
				$direccion=$_POST["direccion"];
				$ciudad=$_POST["ciudad"];
				$id_institucion=$_POST["id_institucion"];

				$host = "localhost"; 
				$user = "root";
				$pass = "";
				$bbdd = "gestionHorarios";

				$conexion_base_de_datos = mysql_connect($host,$user,$pass) or die("resultado1= ".urlencode(mysql_error())); 
				mysql_select_db($bbdd,$conexion_base_de_datos) or die("resultado2= ".urlencode(mysql_error()));
				$consultasql = "insert into sedes values('','$nombre','$correo','$telefono','$direccion','$ciudad','$id_institucion')";
				$retornoconsultasql = mysql_query($consultasql) or die ("resultado3= ".mysql_error());

				if ($retornoconsultasql == true){
					echo "<p id='mensaje'>Exitoso</p>";
				}
				mysql_close($conexion_base_de_datos);

			}

			if(isset($_POST['registrar']))
			{
			    ejecutar2();
			}
//--------------------------- funcion editar

			function ejecutar3()
			{	$id=$_POST["id"];
				$nombre=$_POST["nombre"];
				$correo=$_POST["correo"];
				$telefono=$_POST["telefono"];
				$direccion=$_POST["direccion"];
				$ciudad=$_POST["ciudad"];
				

				$host = "localhost"; 
				$user = "root";
				$pass = "";
				$bbdd = "gestionHorarios";

				$conexion_base_de_datos = mysql_connect($host,$user,$pass) or die("resultado1= ".urlencode(mysql_error())); 
				mysql_select_db($bbdd,$conexion_base_de_datos) or die("resultado2= ".urlencode(mysql_error()));
				$consultasql = "update sedes
								 set nombre='$nombre', correo='$correo', telefono='$telefono',
								 direccion='$direccion', ciudad='$ciudad' where id='$id'";
				$retornoconsultasql = mysql_query($consultasql) or die ("resultado3= ".mysql_error());

				if ($retornoconsultasql == true){
					echo "<p id='mensaje'>Exitoso</p>";
				}
				mysql_close($conexion_base_de_datos);

			}

			if(isset($_POST['editar']))
			{
			    ejecutar3();
			}
//--------------------------- funcion eliminar

			function ejecutar4()
			{
				$id=$_POST["id"];
				
				$host = "localhost"; 
				$user = "root";
				$pass = "";
				$bbdd = "gestionHorarios";

				$conexion_base_de_datos = mysql_connect($host,$user,$pass) or die("resultado1= ".urlencode(mysql_error())); 
				mysql_select_db($bbdd,$conexion_base_de_datos) or die("resultado2= ".urlencode(mysql_error()));
				$consultasql = "delete from sedes where id='$id'";
				$retornoconsultasql = mysql_query($consultasql) or die ("resultado3= ".mysql_error());

				if ($retornoconsultasql == true){
					echo "<p id='mensaje'>Exitoso</p>";
				}
				mysql_close($conexion_base_de_datos);

			}

			if(isset($_POST['eliminar']))
			{
			    ejecutar4();
			}
		?>
	</body>
</html>
<?php
	}
?>