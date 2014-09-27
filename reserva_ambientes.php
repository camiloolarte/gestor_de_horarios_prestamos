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
		<h1>Reserva de Ambientes</h1>
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
				<td><a href="cerrar.php">cerrar sesion</a></td>
			</tr>
		</table>
		<table id="for1">
			<form action="reserva_ambientes.php" method="post" >
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
				$consultasql = "select 

								ambientes.id, ambientes.nombre, ambientes.descripcion, sedes.telefono, sedes.nombre,
								instituciones.nombre

								from sedes

								inner join ambientes
								on sedes.id = ambientes.id_sedes

								inner join instituciones
								on sedes.id_institucion = instituciones.id

								 
								ORDER BY ambientes.id";

				$retornoconsultasql = mysql_query($consultasql) or die ("resultado3= ".mysql_error());

					echo "<table id='resultado'>";  
					echo "<tr id='titulos'>";  
					echo "<th>-id ambiente-</th>";  
					echo "<th>-nombre-</th>";  
					echo "<th>-descripcion-</th>"; 
					echo "<th>-telefono-</th>"; 
					echo "<th>-nombre sede-</th>";  
					echo "<th>-institucion-</th>";
					

					
					
					echo "</tr>";  
					while ($recorre = mysql_fetch_row($retornoconsultasql)){   
					    echo "<tr id='datos' >";  
					    echo "<td>$recorre[0]</td>";  
					    echo "<td>$recorre[1]</td>";  
					    echo "<td>$recorre[2]</td>"; 
					    echo "<td>$recorre[3]</td>";
					    echo "<td>$recorre[4]</td>";
					    echo "<td>$recorre[5]</td>";
					   
					    
					
					    
					    echo "</tr>";  
					}  
					echo "</table>"; 

					echo '<form action="reserva_ambientes.php" method="post" id="for2">

						    tipo: <input type="text" name="tipo"><br />
						    fecha_inicio: <input type="date" name="fecha_inicio"><br />
						    fecha_fin: <input type="date" name="fecha_fin"><br />
						    hora_inicio: <input type="time" name="hora_inicio"><br />
						    hora_fin: <input type="time" name="hora_fin"><br />
						    id_ambiente: <input type="number" name="id_ambiente"><br />
						    id_instructor: <input type="number" name="id_instructor"><br />
						    id_grupo: <input type="number" name="id_grupo"><br />						    

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
								
										reservaAmbientes.id,reservaAmbientes.fecha_inicio,reservaAmbientes.fecha_fin,
										reservaAmbientes.dia_semana,reservaAmbientes.hora_inicio,
										reservaAmbientes.hora_fin, ambientes.nombre, sedes.nombre,
										reservaAmbientes.aprobado

										from reservaAmbientes

										inner join ambientes
										on reservaAmbientes.id_ambiente = ambientes.id

										inner join sedes
										on ambientes.id_sedes = sedes.id

										where aprobado='si'";

						$retornoconsultasql = mysql_query($consultasql) or die ("resultado3= ".mysql_error());

						echo "<table id='resultado'>";  
					echo "<tr id='titulos'>";  
					echo "<th>-id-</th>";  
					echo "<th>-fecha_inicio-</th>";  
					echo "<th>-fecha_fin-</th>"; 
					echo "<th>-dia de la semana-</th>"; 
					echo "<th>-hora inicio-</th>";  
					echo "<th>-hora fin-</th>";
					echo "<th>-nombre ambiente-</th>";
					echo "<th>-sede-</th>";	
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
					    
					    echo "</tr>";  
					}  
					echo "</table>"; 
					echo '<form action="reserva_ambientes.php" method="post" id="for2">

							id: <input type="number" name="id"><br />
							tipo: <input type="text" name="tipo"><br />
						    fecha_inicio: <input type="date" name="fecha_inicio"><br />
						    fecha_fin: <input type="date" name="fecha_fin"><br />
						    hora_inicio: <input type="time" name="hora_inicio"><br />
						    hora_fin: <input type="time" name="hora_fin"><br />
						    id_ambiente: <input type="number" name="id_ambiente"><br />
						    id_instructor: <input type="number" name="id_instructor"><br />
						    id_grupo: <input type="number" name="id_grupo"><br />
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
						$consultasql = "select  
								
										reservaAmbientes.id,reservaAmbientes.fecha_inicio,reservaAmbientes.fecha_fin,
										reservaAmbientes.dia_semana,reservaAmbientes.hora_inicio,
										reservaAmbientes.hora_fin, ambientes.nombre, sedes.nombre,
										reservaAmbientes.aprobado

										from reservaAmbientes

										inner join ambientes
										on reservaAmbientes.id_ambiente = ambientes.id

										inner join sedes
										on ambientes.id_sedes = sedes.id

										where aprobado='si'";

						$retornoconsultasql = mysql_query($consultasql) or die ("resultado3= ".mysql_error());

						echo "<table id='resultado'>";  
					echo "<tr id='titulos'>";  
					echo "<th>-id-</th>";  
					echo "<th>-fecha_inicio-</th>";  
					echo "<th>-fecha_fin-</th>"; 
					echo "<th>-dia de la semana-</th>"; 
					echo "<th>-hora inicio-</th>";  
					echo "<th>-hora fin-</th>";
					echo "<th>-nombre ambiente-</th>";
					echo "<th>-sede-</th>";	
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
					    
					    echo "</tr>";  
					}  
					echo "</table>"; 

					echo '<form action="reserva_ambientes.php" method="post" id="for2">
					
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
						$consultasql = "select  
								
										reservaAmbientes.id,reservaAmbientes.fecha_inicio,reservaAmbientes.fecha_fin,
										reservaAmbientes.dia_semana,reservaAmbientes.hora_inicio,
										reservaAmbientes.hora_fin, ambientes.nombre, sedes.nombre,
										reservaAmbientes.aprobado

										from reservaAmbientes

										inner join ambientes
										on reservaAmbientes.id_ambiente = ambientes.id

										inner join sedes
										on ambientes.id_sedes = sedes.id

										where aprobado='no'";

						$retornoconsultasql = mysql_query($consultasql) or die ("resultado3= ".mysql_error());

						echo "<table id='resultado'>";  
					echo "<tr id='titulos'>";  
					echo "<th>-id-</th>";  
					echo "<th>-fecha_inicio-</th>";  
					echo "<th>-fecha_fin-</th>"; 
					echo "<th>-dia de la semana-</th>"; 
					echo "<th>-hora inicio-</th>";  
					echo "<th>-hora fin-</th>";
					echo "<th>-nombre ambiente-</th>";
					echo "<th>-sede-</th>";	
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
					    
					    echo "</tr>";  
					}  
					echo "</table>"; 
					
					mysql_close($conexion_base_de_datos);

					echo '<form action="reserva_ambientes.php" method="post" id="for2">
						
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
				
				$id=$_POST["id"];
				$fecha_inicio=$_POST["fecha_inicio"];
				$fecha_fin=$_POST["fecha_fin"];
				$hora_inicio=$_POST["hora_inicio"];
				$hora_fin=$_POST["hora_fin"];
				$id_ambiente=$_POST["id_ambiente"];
				$id_instructor=$_POST["id_instructor"];
				$id_grupo=$_POST["id_grupo"];
				$aprobado=$_POST["aprobado"];

				$host = "localhost"; 
				$user = "root";
				$pass = "";
				$bbdd = "gestionHorarios";

				$conexion_base_de_datos = mysql_connect($host,$user,$pass) or die("resultado1= ".urlencode(mysql_error())); 
				mysql_select_db($bbdd,$conexion_base_de_datos) or die("resultado2= ".urlencode(mysql_error()));
				$consultasql = "insert into reservaAmbientes values('','$fecha_inicio','$fecha_fin','$hora_inicio',
							'$hora_fin','$id_ambiente','$id_instructor','$id_grupo','si')";
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
				$fecha_inicio=$_POST["fecha_inicio"];
				$fecha_fin=$_POST["fecha_fin"];
				$hora_inicio=$_POST["hora_inicio"];
				$hora_fin=$_POST["hora_fin"];
				$id_ambiente=$_POST["id_ambiente"];
				$id_instructor=$_POST["id_instructor"];
				$id_grupo=$_POST["id_grupo"];
				$aprobado=$_POST["aprobado"];

				$host = "localhost"; 
				$user = "root";
				$pass = "";
				$bbdd = "gestionHorarios";

				$conexion_base_de_datos = mysql_connect($host,$user,$pass) or die("resultado1= ".urlencode(mysql_error())); 
				mysql_select_db($bbdd,$conexion_base_de_datos) or die("resultado2= ".urlencode(mysql_error()));
				$consultasql = "update reservaAmbientes set fecha_inicio='$fecha_inicio', fecha_fin='$fecha_fin', hora_inicio='$hora_inicio', hora_fin='$hora_fin'
								, id_ambiente='$id_ambiente', id_instructor='$id_instructor', id_grupo='$id_grupo', aprobado='$aprobado' where id='$id'";
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
				$consultasql = "delete from reservaAmbientes where id='$id'";
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
					$consultasql = "update reservaAmbientes set id='',fecha_inicio='', fecha_fin='', hora_inicio='', hora_fin=''
								, id_ambiente='', id_instructor='', id_grupo='', aprobado='si' where id='$id'";
					$retornoconsultasql = mysql_query($consultasql) or die ("resultado3= ".mysql_error());

					if ($retornoconsultasql == true){
					echo "<p id='mensaje'>Exitoso</p>";
				}
				mysql_close($conexion_base_de_datos);

				}elseif ($aprueba == "no") {
					$conexion_base_de_datos = mysql_connect($host,$user,$pass) or die("resultado1= ".urlencode(mysql_error())); 
					mysql_select_db($bbdd,$conexion_base_de_datos) or die("resultado2= ".urlencode(mysql_error()));
					$consultasql = "delete from reservaAmbientes where id='$id'";
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