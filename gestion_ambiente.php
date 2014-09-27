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
		<h1>Gestion de Ambientes</h1>
		<table  id="links">
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
			<form action="gestion_ambiente.php" method="post" >
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
					$consultasql = "select
									sedes.id,sedes.nombre,sedes.correo,sedes.telefono,sedes.direccion,sedes.ciudad,
									instituciones.nombre
									from sedes
									inner join instituciones
									on sedes.id_institucion = instituciones.id
									";
					$retornoconsultasql = mysql_query($consultasql) or die ("resultado3= ".mysql_error());
					
					echo "<table id='resultado'>";  
						echo "<tr id='titulos'>";  
						echo "<th>-id sedes-</th>";  
						echo "<th>-nombre-</th>";  
						echo "<th>-correo-</th>"; 
						echo "<th>-telefono-</th>"; 
						echo "<th>-direccion-</th>";  
						echo "<th>-ciudad-</th>"; 
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

					echo '<form action="gestion_ambiente.php" method="post" id="for2">

							
						    nombre: <input type="text" name="nombre"><br />						    
						    tipo: <input type="text" name="tipo"><br />
						    descripcion: <input type="text" name="descripcion"><br />
						    id_sedes: <input type="number" name="id_sedes"><br />

						    <input type="submit" name="registrar" value="Enviar" />
						</form>';
				} elseif ($decide == "editar") {


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
						echo "<th>-nombre-</th>";  
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

					echo '<form action="gestion_ambiente.php" method="post" id="for2" >

							id: <input type="number" name="id"><br />
						    nombre: <input type="text" name="nombre"><br />						    
						    tipo: <input type="text" name="tipo"><br />
						    descripcion: <input type="text" name="descripcion"><br />
						    id_sedes: <input type="number" name="id_sedes"><br />
						     						    		   
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
									ambientes.id,ambientes.nombre,ambientes.tipo,ambientes.descripcion,
									sedes.nombre
									from ambientes
									inner join sedes
									on ambientes.id_sedes = sedes.id";
					$retornoconsultasql = mysql_query($consultasql) or die ("resultado3= ".mysql_error());
					
					echo "<table id='resultado'>";  
						echo "<tr id='titulos'>";  
						echo "<th>-id-</th>";  
						echo "<th>-nombre-</th>";  
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
					echo '<form action="gestion_ambiente.php" method="post" id="for2">
					
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
				$tipo=$_POST["tipo"];
				$descripcion=$_POST["descripcion"];
				$id_sedes=$_POST["id_sedes"];
				
				$host = "localhost"; 
				$user = "root";
				$pass = "";
				$bbdd = "gestionHorarios";

				$conexion_base_de_datos = mysql_connect($host,$user,$pass) or die("resultado1= ".urlencode(mysql_error())); 
				mysql_select_db($bbdd,$conexion_base_de_datos) or die("resultado2= ".urlencode(mysql_error()));
				$consultasql = "insert into ambientes values('','$nombre','$tipo','$descripcion','$id_sedes')";
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
				$nombre=$_POST["nombre"];
				$tipo=$_POST["tipo"];
				$descripcion=$_POST["descripcion"];
				$id_sedes=$_POST["id_sedes"];
				

				$host = "localhost"; 
				$user = "root";
				$pass = "";
				$bbdd = "gestionHorarios";

				$conexion_base_de_datos = mysql_connect($host,$user,$pass) or die("resultado1= ".urlencode(mysql_error())); 
				mysql_select_db($bbdd,$conexion_base_de_datos) or die("resultado2= ".urlencode(mysql_error()));
				$consultasql = "update ambientes set nombre='$nombre', tipo='$tipo', descripcion='$descripcion', id_sedes='$id_sedes' where id='$id'";
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
				$consultasql = "delete from ambientes where id='$id'";
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