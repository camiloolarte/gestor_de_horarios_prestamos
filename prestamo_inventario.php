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
		<h1>Prestamo de Inventario</h1>
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
				<td><a href="reserva_ambientes.php">reservar ambiente</a></td>
			</tr>
			<tr>
				<td><a href="cerrar.php">cerrar sesion</a></td>
			</tr>
		</table>
		<table id="for1">
			<form action="prestamo_inventario.php" method="post" >
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
			    	<td><input type="radio" name="decide" value="solicita" /></td>
			    	<td>solicitudes:</td>
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
					$consultasql = "select * from prestamoInventario where aprobado='si'";
					$retornoconsultasql = mysql_query($consultasql) or die ("resultado3= ".mysql_error());

					echo "<table id='resultado'>";  
					echo "<tr id='titulos'>";  
						echo "<th>-id-</th>";  
						echo "<th>-tipo-</th>";  
						echo "<th>-id inventario-</th>"; 
						echo "<th>-cantidad-</th>"; 
						echo "<th>-fecha-</th>";  
						echo "<th>-hora inicio-</th>";
						echo "<th>-hora fin-</th>";
						echo "<th>-nombre instructor-</th>";
						echo "<th>-id instructor-</th>";
						echo "<th>-aprobado-</th>";
						
						
						echo "</tr>";  
						while ($recorre = mysql_fetch_row($retornoconsultasql)){   
						    echo "<tr id='datos' >";  
						    echo "<td>$recorre[0]</td>";  
						    echo "<td>$recorre[1]</td>";  
						    echo "<td>$recorre[2]</td>"; 
						    echo "<td>$recorre[3]</td>";
						    echo "<td>$recorre[4]</td>";
						    echo "<td>$recorre[5]</td>"; 
						    echo "<td>$recorre[6]</td>";
						    echo "<td>$recorre[7]</td>";
						    echo "<td>$recorre[8]</td>";
						    echo "<td>$recorre[9]</td>";
						   
						    echo "</tr>";  
						}  
						echo "</table>";
						mysql_close($conexion_base_de_datos); 

					echo '<form action="prestamo_inventario.php" method="post" id="for2">

						    tipo: <input type="text" name="tipo"><br />
						    id_inventario: <input type="number" name="id_inventario"><br />
						    cantidad: <input type="number" name="cantidad"><br />
						    fecha: <input type="date" name="fecha"><br />
						    hora_inicio: <input type="time" name="hora_inicio"><br />
						    hora_fin: <input type="time" name="hora_fin"><br />
						    nombre: <input type="text" name="nombre"><br />
						    id_instructor: <input type="date" name="id_instructor"><br />
						    aprobado: <input type="text" name="aprobado"><br />

						    <input type="submit" name="registrar" value="Registrar" />
						</form>';
				} elseif ($decide == "editar") {

					$host = "localhost"; 
					$user = "root";
					$pass = "";
					$bbdd = "gestionHorarios";

					$conexion_base_de_datos = mysql_connect($host,$user,$pass) or die("resultado1= ".urlencode(mysql_error())); 
					mysql_select_db($bbdd,$conexion_base_de_datos) or die("resultado2= ".urlencode(mysql_error()));
					$consultasql = "select * from prestamoInventario where aprobado='si'";
					$retornoconsultasql = mysql_query($consultasql) or die ("resultado3= ".mysql_error());

					echo "<table id='resultado'>";  
					echo "<tr id='titulos'>";  
						echo "<th>-id-</th>";  
						echo "<th>-tipo-</th>";  
						echo "<th>-id inventario-</th>"; 
						echo "<th>-cantidad-</th>"; 
						echo "<th>-fecha-</th>";  
						echo "<th>-hora inicio-</th>";
						echo "<th>-hora fin-</th>";
						echo "<th>-nombre instructor-</th>";
						echo "<th>-id instructor-</th>";
						echo "<th>-aprobado-</th>";
						
						
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
						    echo "<td>$recorre[8]</td>";
						    echo "<td>$recorre[9]</td>";

						   
						    echo "</tr>";  
						}  
						echo "</table>";
						mysql_close($conexion_base_de_datos); 

					echo '<form action="prestamo_inventario.php" method="post" id="for2">

							id: <input type="number" name="id"><br />
							tipo: <input type="text" name="tipo"><br />
						    id_inventario: <input type="number" name="id_inventario"><br />
						    cantidad: <input type="number" name="cantidad"><br />
						    fecha: <input type="date" name="fecha"><br />
						    hora_inicio: <input type="time" name="hora_inicio"><br />
						    hora_fin: <input type="time" name="hora_fin"><br />
						    nombre: <input type="text" name="nombre"><br />
						    id_instructor: <input type="date" name="id_instructor"><br />
						    aprobado: <input type="text" name="aprobado"><br />
						     						    		   
						    <input type="submit" name="editar" value="Editar" />
						</form>';
				}elseif ($decide == "eliminar") {
				
						$host = "localhost"; 
						$user = "root";
						$pass = "";
						$bbdd = "gestionHorarios";

						$conexion_base_de_datos = mysql_connect($host,$user,$pass) or die("resultado1= ".urlencode(mysql_error())); 
						mysql_select_db($bbdd,$conexion_base_de_datos) or die("resultado2= ".urlencode(mysql_error()));
						$consultasql = "select * from prestamoInventario where aprobado='si'";
						$retornoconsultasql = mysql_query($consultasql) or die ("resultado3= ".mysql_error());

						echo "<table id='resultado'>";  
						echo "<tr id='titulos'>";  
							echo "<th>-id-</th>";  
							echo "<th>-tipo-</th>";  
							echo "<th>-id_inventario-</th>"; 
							echo "<th>-cantidad-</th>"; 
							echo "<th>-fecha-</th>";  
							echo "<th>-hora_inicio-</th>";
							echo "<th>-hora_fin-</th>";
							echo "<th>-nombre instructor-</th>";
							echo "<th>-id_instructor-</th>";
							echo "<th>-aprobado-</th>";
							
							
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
							    echo "<td>$recorre[8]</td>";
							    echo "<td>$recorre[9]</td>";
							   
							    echo "</tr>";  
							}  
							echo "</table>"; 
							mysql_close($conexion_base_de_datos);
					echo '<form action="prestamo_inventario.php" method="post" id="for2">
					
							id: <input type="number" name="id"><br />
						    						     						    		   
						    <input type="submit" name="eliminar" value="Eliminar" />
						</form>
					';
					}elseif ($decide == "solicita") {
						$host = "localhost"; 
						$user = "root";
						$pass = "";
						$bbdd = "gestionHorarios";

						$conexion_base_de_datos = mysql_connect($host,$user,$pass) or die("resultado1= ".urlencode(mysql_error())); 
						mysql_select_db($bbdd,$conexion_base_de_datos) or die("resultado2= ".urlencode(mysql_error()));
						$consultasql = "select * from prestamoInventario where aprobado='no'";
						$retornoconsultasql = mysql_query($consultasql) or die ("resultado3= ".mysql_error());

						echo "<table id='resultado'>";  
						echo "<tr id='titulos'>";  
							echo "<th>-id-</th>";  
							echo "<th>-tipo-</th>";  
							echo "<th>-id inventario-</th>"; 
							echo "<th>-cantidad-</th>"; 
							echo "<th>-fecha-</th>";  
							echo "<th>-hora inicio-</th>";
							echo "<th>-hora fin-</th>";
							echo "<th>-nombre instructor-</th>";
							echo "<th>-id instructor-</th>";
							echo "<th>-´probado-</th>";
							
							
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
							    echo "<td>$recorre[8]</td>";
							    echo "<td>$recorre[9]</td>";
							   
							    
							    echo "</tr>";  
							}  
							echo "</table>";  
						mysql_close($conexion_base_de_datos);

						echo '<form action="prestamo_inventario.php" method="post" id="for2">
							
									id: <input type="number" name="id"><br />
									aprueba: <input type="radio" name="aprueba" value="si"><br />
									no aprueba: <input type="radio" name="aprueba" value="no"><br />
								    						     						    		   
								    <input type="submit" name="aprueba" value="Aplicar" />
								</form>';	
						
					}
			}

							

			 if(isset($_POST['submit1']))
			{
			    ejecutar1();
			}

			
//--------------------------- funcion registrar

			
			function ejecutar2()
			{
				
				$tipo=$_POST["tipo"];
				$id_inventario=$_POST["id_inventario"];
				$cantidad=$_POST["cantidad"];
				$fecha=$_POST["fecha"];
				$hora_inicio=$_POST["hora_inicio"];
				$hora_fin=$_POST["hora_fin"];
				$nombre=$_POST["nombre"];
				$id_instructor=$_POST["id_instructor"];
				$aprobado=$_POST["aprobado"];

				$host = "localhost"; 
				$user = "root";
				$pass = "";
				$bbdd = "gestionHorarios";

				$conexion_base_de_datos = mysql_connect($host,$user,$pass) or die("resultado1= ".urlencode(mysql_error())); 
				mysql_select_db($bbdd,$conexion_base_de_datos) or die("resultado2= ".urlencode(mysql_error()));
				$consultasql = "insert into prestamoInventario values('','$tipo','$id_inventario','$cantidad',
							'$fecha','$hora_inicio','$hora_fin','$nombre','$id_instructor','$aprobado')";
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
				$tipo=$_POST["tipo"];
				$id_inventario=$_POST["id_inventario"];
				$cantidad=$_POST["cantidad"];
				$fecha=$_POST["fecha"];
				$hora_inicio=$_POST["hora_inicio"];
				$hora_fin=$_POST["hora_fin"];
				$nombre=$_POST["nombre"];
				$id_instructor=$_POST["id_instructor"];
				$aprobado=$_POST["aprobado"];

				$host = "localhost"; 
				$user = "root";
				$pass = "";
				$bbdd = "gestionHorarios";

				$conexion_base_de_datos = mysql_connect($host,$user,$pass) or die("resultado1= ".urlencode(mysql_error())); 
				mysql_select_db($bbdd,$conexion_base_de_datos) or die("resultado2= ".urlencode(mysql_error()));
				$consultasql = "update prestamoInventario set tipo='$tipo', id_inventario='$id_inventario', cantidad='$cantidad', fecha='$fecha'
								, hora_inicio='$hora_inicio', hora_fin='$hora_fin', nombre='$nombre', id_instructor='$id_instructor', aprobado='$aprobado' where id='$id'";
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


//--------------------------- funcion eliminar2

			function ejecutar4()
			{
				$id=$_POST["id"];
				
				$host = "localhost"; 
				$user = "root";
				$pass = "";
				$bbdd = "gestionHorarios";

				$conexion_base_de_datos = mysql_connect($host,$user,$pass) or die("resultado1= ".urlencode(mysql_error())); 
				mysql_select_db($bbdd,$conexion_base_de_datos) or die("resultado2= ".urlencode(mysql_error()));
				$consultasql = "delete from prestamoInventario where id='$id'";
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

//--------------------------- funcion aprobar

			function ejecutar5()
			{
				$aprueba=$_POST["aprueba"];


				if ($aprueba == "si") {

					$conexion_base_de_datos = mysql_connect($host,$user,$pass) or die("resultado1= ".urlencode(mysql_error())); 
					mysql_select_db($bbdd,$conexion_base_de_datos) or die("resultado2= ".urlencode(mysql_error()));
					$consultasql = "update prestamoInventario set tipo='', id_inventario='', cantidad='', fecha=''
								, hora_inicio='', hora_fin='', nombre='', id_instructor='', aprobado='si' where id='$id'";
					$retornoconsultasql = mysql_query($consultasql) or die ("resultado3= ".mysql_error());

					if ($retornoconsultasql == true){
					echo "<p id='mensaje'>Exitoso</p>";
				}
				mysql_close($conexion_base_de_datos);

				}elseif ($aprueba == "no") {
					$conexion_base_de_datos = mysql_connect($host,$user,$pass) or die("resultado1= ".urlencode(mysql_error())); 
					mysql_select_db($bbdd,$conexion_base_de_datos) or die("resultado2= ".urlencode(mysql_error()));
					$consultasql = "delete from prestamoInventario where id='$id'";
					$retornoconsultasql = mysql_query($consultasql) or die ("resultado3= ".mysql_error());

					if ($retornoconsultasql == true){
					echo "<p id='mensaje'>Exitoso</p>";
				}
				mysql_close($conexion_base_de_datos);
				}
				
			}

			if(isset($_POST['aprueba']))
			{
			    ejecutar5();
			}
		?>

	</body>
</html>

<?php
	}
?>
