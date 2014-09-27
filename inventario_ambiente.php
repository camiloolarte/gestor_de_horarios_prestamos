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
		<h1>Gestion de Inventario en Ambientes</h1>
		<table id="links" >
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
			<form action="inventario_ambiente.php" method="post" >
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
			    	
			    	<td><input type="radio" name="decide" value="buscar" /></td>
			    	<td>buscar</td>
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
					$consultasql = "select
									ambientes.id,ambientes.nombre,ambientes.tipo,ambientes.descripcion,
									sedes.nombre
									from ambientes
									inner join sedes
									on ambientes.id_sedes = sedes.id";
					$retornoconsultasql = mysql_query($consultasql) or die ("resultado3= ".mysql_error());
					
					echo "<table id='resultado'>";  
						echo "<tr id='titulos'>";  
						echo "<th>-id-</th>";  
						echo "<th>-nombre ambiente-</th>";  
						echo "<th>-tipo-</th>"; 
						echo "<th>-descripcion-</th>"; 
						echo "<th>-sede-</th>";  
										
						
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
					mysql_close($conexion_base_de_datos);

					echo '<form action="inventario_ambiente.php" method="post" id="for2">

							cantidad: <input type="text" name="cantidad"><br />						    
						    tipo: <input type="text" name="tipo"><br />
						    descripcion: <input type="text" name="descripcion"><br />
						    id_ambiente: <input type="number" name="id_ambiente"><br />

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
									inventario.id,inventario.cantidad,inventario.tipo,inventario.descripcion,
									ambientes.nombre,sedes.nombre,instituciones.nombre
									from inventario

									inner join ambientes
									on inventario.id_ambiente = ambientes.id

									inner join sedes
									on ambientes.id_sedes = sedes.id

									inner join instituciones
									on sedes.id_institucion = instituciones.id

									order by inventario.id";

					$retornoconsultasql = mysql_query($consultasql) or die ("resultado3= ".mysql_error());
					
					echo "<table id='resultado'>";  
						echo "<tr id='titulos'>";  
						echo "<th>-id-</th>";  
						echo "<th>-cantidad-</th>";  
						echo "<th>-tipo-</th>"; 
						echo "<th>-descripcion-</th>"; 
						echo "<th>-ambiente-</th>";  
						echo "<th>-sede-</th>";
						echo "<th>-institucion-</th>";
										
						
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
						    
						   
						    echo "</tr>";  
						}  
						echo "</table>"; 
					mysql_close($conexion_base_de_datos);


					echo '<form action="inventario_ambiente.php" method="post" id="for2">

							id: <input type="number" name="id"><br />
						    cantidad: <input type="text" name="cantidad"><br />						    
						    tipo: <input type="text" name="tipo"><br />
						    descripcion: <input type="text" name="descripcion"><br />
						    id_ambiente: <input type="number" name="id_ambiente"><br />
						     						    		   
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
									inventario.id,inventario.cantidad,inventario.tipo,inventario.descripcion,
									ambientes.nombre,sedes.nombre,instituciones.nombre
									from inventario

									inner join ambientes
									on inventario.id_ambiente = ambientes.id

									inner join sedes
									on ambientes.id_sedes = sedes.id

									inner join instituciones
									on sedes.id_institucion = instituciones.id

									order by inventario.id";

					$retornoconsultasql = mysql_query($consultasql) or die ("resultado3= ".mysql_error());
					
					echo "<table id='resultado'>";  
						echo "<tr id='titulos'>";  
						echo "<th>-id-</th>";  
						echo "<th>-cantidad-</th>";  
						echo "<th>-tipo-</th>"; 
						echo "<th>-descripcion-</th>"; 
						echo "<th>-ambiente-</th>";  
						echo "<th>-sede-</th>";
						echo "<th>-institucion-</th>";
										
						
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
						    
						   
						    echo "</tr>";  
						}  
						echo "</table>";
					echo '<form action="inventario_ambiente.php" method="post" id="for2"> 
					
							id: <input type="number" name="id"><br />
						    						     						    		   
						    <input type="submit" name="eliminar" value="Eliminar" />
						</form>
					';
				}elseif ($decide == "buscar") {

					echo '<form action="inventario_ambiente.php" method="post" id="for2">
					
							tipo: <input type="text" name="tipo"><br />
						    						     						    		   
						    <input type="submit" name="buscar" value="Buscar" />
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
				
				$cantidad=$_POST["cantidad"];
				$tipo=$_POST["tipo"];
				$descripcion=$_POST["descripcion"];
				$id_ambiente=$_POST["id_ambiente"];
				
				$host = "localhost"; 
				$user = "root";
				$pass = "";
				$bbdd = "gestionHorarios";

				$conexion_base_de_datos = mysql_connect($host,$user,$pass) or die("resultado1= ".urlencode(mysql_error())); 
				mysql_select_db($bbdd,$conexion_base_de_datos) or die("resultado2= ".urlencode(mysql_error()));
				$consultasql = "insert into inventario values('','$cantidad','$tipo','$descripcion','$id_ambiente')";
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
			{	
				$id=$_POST["id"];
				$cantidad=$_POST["cantidad"];
				$tipo=$_POST["tipo"];
				$descripcion=$_POST["descripcion"];
				$id_ambiente=$_POST["id_ambiente"];

				$host = "localhost"; 
				$user = "root";
				$pass = "";
				$bbdd = "gestionHorarios";

				$conexion_base_de_datos = mysql_connect($host,$user,$pass) or die("resultado1= ".urlencode(mysql_error())); 
				mysql_select_db($bbdd,$conexion_base_de_datos) or die("resultado2= ".urlencode(mysql_error()));
				$consultasql = "update inventario set cantidad='$cantidad', tipo='$tipo', descripcion='$descripcion', id_ambiente='$id_ambiente' where id='$id'";
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
				$consultasql = "delete from inventario where id='$id'";
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
//------------------------------------ funcion buscar
			function ejecutar5()
			{
				$tipo=$_POST["tipo"];

				$host = "localhost"; 
				$user = "root";
				$pass = "";
				$bbdd = "gestionHorarios";

				$conexion_base_de_datos = mysql_connect($host,$user,$pass) or die("resultado1= ".urlencode(mysql_error())); 
				mysql_select_db($bbdd,$conexion_base_de_datos) or die("resultado2= ".urlencode(mysql_error()));
				$consultasql = "select
								inventario.id,inventario.cantidad,inventario.tipo,inventario.descripcion,
								ambientes.nombre,sedes.nombre,instituciones.nombre
								from inventario

								inner join ambientes
								on inventario.id_ambiente = ambientes.id

								inner join sedes
								on ambientes.id_sedes = sedes.id

								inner join instituciones
								on sedes.id_institucion = instituciones.id

								where inventario.tipo ='$tipo'";

				$retornoconsultasql = mysql_query($consultasql) or die ("resultado3= ".mysql_error());
				
				echo "<table id='resultado'>";  
						echo "<tr id='titulos'>";  
					echo "<th>-id-</th>";  
					echo "<th>-cantidad-</th>";  
					echo "<th>-tipo-</th>"; 
					echo "<th>-descripcion-</th>"; 
					echo "<th>-ambiente-</th>";  
					echo "<th>-sede-</th>";
					echo "<th>-institucion-</th>";
									
					
					echo "</tr>";  
					while ($recorre = mysql_fetch_row($retornoconsultasql)){   
					    echo "<tr>";  
					    echo "<td>$recorre[0]</td>";  
					    echo "<td>$recorre[1]</td>";  
					    echo "<td>$recorre[2]</td>"; 
					    echo "<td>$recorre[3]</td>";
					    echo "<td>$recorre[4]</td>";
					    echo "<td>$recorre[5]</td>";
					    echo "<td>$recorre[6]</td>";
					    
					   
					    echo "</tr>";  
					}  
					echo "</table>"; 
				if ($retornoconsultasql == true){
					echo "<p id='mensaje'>Exitoso</p>";
				}
				mysql_close($conexion_base_de_datos);

			}

			if(isset($_POST['buscar']))
			{
			    ejecutar5();
			}
		?>
	</body>
</html>

<?php
	}
?>