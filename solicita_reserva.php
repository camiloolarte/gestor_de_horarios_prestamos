<?php
session_start();

if($_SESSION["rolusuario"] != 2){
	header("location:index.php?resp=noInstructor");
}else{
?>

<html>
	<head>
		<meta charset="UTF-8">
		<title>Gestion de Horarios</title>
		<link rel="stylesheet" href="estilos.css">

		<style type="text/css">

			#links1 {
				text-transform: capitalize;
				font-size: 16px;
				position:absolute;
			    width: 20%;
			    top: 100px;
			    left: 10px;		    
			}
			#links1 td {
				border: 1px solid blue;			    
			    padding-left: 5%;
			    background-color: white;}
			#for3 {
				position:absolute;
				color: white;
				width: 19%;
				top: 30%;
				text-transform: capitalize;
				font-size: 16px;
				text-shadow: 2px 2px 8px black;			    			    
			}
			#for3 input{				
				width: 100%;					    			    
			} 

		</style> 

	</head>
	<body>
		<h1>reservar ambiente</h1>
		<table id="links1">
			<tr>
				<td><a href="instructor.php">inicio</a></td>
			</tr>
			<tr>
				<td><a href="i_solicita_prestamo.php">solicitar reserva de inventario</a></td>
			</tr>
			<tr>
				<td><a href="cerrar.php">cerrar sesion</a> </td>
			</tr>			
		</table>
		<table id="for1">
			<form action="solicita_reserva.php" method="post" >
				<tr>
					<td></td>
					<td><h4>solicitar formulario de:</h4></td>
				</tr>
				<tr>			    	
			    	<td> <input type="radio" name="decide" value="resgistrar" /></td>
			    	<td>peticion de prestamo</td>
			    </tr>
			    <tr>
			    	
			    	<td><input type="radio" name="decide" value="buscar" /></td>
			    	<td>disponibilidad</td>
			    </tr>
			    <tr>			    	
			    	<td><input type="radio" name="decide" value="cancelar" /></td>
			    	<td>cancelar peticion</td>
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
									reservaAmbientes.aprobado,reservaAmbientes.dia_semana,reservaAmbientes.hora_inicio,
									reservaAmbientes.hora_fin

									from sedes

									inner join ambientes
									on sedes.id = ambientes.id_sedes

									inner join reservaAmbientes
									on ambientes.id = reservaAmbientes.id_ambiente
 
									ORDER BY ambientes.id";

					$retornoconsultasql = mysql_query($consultasql) or die ("resultado3= ".mysql_error());

						echo "<table id='resultado'>";  
					echo "<tr id='titulos'>";  
						echo "<th>-id ambiente-</th>";  
						echo "<th>-nombre-</th>";  
						echo "<th>-descripcion-</th>"; 
						echo "<th>-telefono-</th>"; 
						echo "<th>-nombre sede-</th>";  
						echo "<th>-aprobado-</th>";
						echo "<th>-dia de la semana-</th>";
						echo "<th>-hora inicio-</th>";
						echo "<th>-hora fin-</th>";

						
						
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

					echo '<form action="solicita_reserva.php" method="post" id="for3">

						    tipo: <input type="text" name="tipo"><br />
						    fecha_inicio: <input type="date" name="fecha_inicio"><br />
						    fecha_fin: <input type="date" name="fecha_fin"><br />
						    dia_semana: <input type="text" name="dia"><br />
						    hora_inicio: <input type="time" name="hora_inicio"><br />
						    hora_fin: <input type="time" name="hora_fin"><br />
						    id_ambiente: <input type="number" name="id_ambiente"><br />
						    id_instructor: <input type="number" name="id_instructor"><br />
						    id_grupo: <input type="number" name="id_grupo"><br />
						    
						    <input type="submit" name="registrar" value="Registrar" />
						</form>';
				} elseif ($decide == "buscar") {

					$host = "localhost"; 
					$user = "root";
					$pass = "";
					$bbdd = "gestionHorarios";

					$conexion_base_de_datos = mysql_connect($host,$user,$pass) or die("resultado1= ".urlencode(mysql_error())); 
					mysql_select_db($bbdd,$conexion_base_de_datos) or die("resultado2= ".urlencode(mysql_error()));
					$consultasql = "select sedes.id,sedes.nombre,sedes.correo,sedes.telefono,sedes.direccion,
					sedes.ciudad,instituciones.nombre
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
					echo "<th>-dirreccion-</th>";  
					echo "<th>-ciudad-</th>";
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
					    echo "<td>$recorre[6]</td>";
					    
					    echo "</tr>";  
					}  
					echo "</table>";  

					if ($retornoconsultasql == true){
						echo "<p id='mensaje'>Exitoso</p>";
					}
					mysql_close($conexion_base_de_datos);


					echo '<form action="solicita_reserva.php" method="post" id="for3">

							
							sede id: <input type="number" name="sede"><br />
						    						     						    		   
						    <input type="submit" name="buscar" value="Buscar" />
						</form>';
				}elseif ($decide == "cancelar") {

					echo '<form action="solicita_reserva.php" method="post" id="for3">
					
							id instructor: <input type="number" name="id_instructor"><br />
						    						     						    		   
						    <input type="submit" name="cancelar" value="Buscar" />
						</form>
					';
				}
			}

							

			 if(isset($_POST['submit1']))
			{
			    ejecutar1();
			}

//--------------------- registrar solicitud

			function ejecutar2(){

			
				$fecha_inicio=$_POST["fecha_inicio"];
				$fecha_fin=$_POST["fecha_fin"];
				$dia=$_POST["dia"];
				$hora_inicio=$_POST["hora_inicio"];
				$hora_fin=$_POST["hora_fin"];
				$id_ambiente=$_POST["id_ambiente"];
				$id_instructor=$_POST["id_instructor"];
				$id_grupo=$_POST["id_grupo"];
				

				$host = "localhost"; 
				$user = "root";
				$pass = "";
				$bbdd = "gestionHorarios";

				$conexion_base_de_datos = mysql_connect($host,$user,$pass) or die("resultado1= ".urlencode(mysql_error())); 
				mysql_select_db($bbdd,$conexion_base_de_datos) or die("resultado2= ".urlencode(mysql_error()));
				$consultasql = "insert into reservaAmbientes values('','$fecha_inicio','$fecha_fin','$dia','$hora_inicio',
							'$hora_fin','$id_ambiente','$id_instructor','$id_grupo','no')";
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

//---------------------  buscar
			
			function ejecutar3(){


				
				$sede=$_POST["sede"];
			
				$host = "localhost"; 
				$user = "root";
				$pass = "";
				$bbdd = "gestionHorarios";

				$conexion_base_de_datos = mysql_connect($host,$user,$pass) or die("resultado1= ".urlencode(mysql_error())); 
				mysql_select_db($bbdd,$conexion_base_de_datos) or die("resultado2= ".urlencode(mysql_error()));
				$consultasql = "select 

								ambientes.id, ambientes.nombre, ambientes.descripcion, sedes.telefono, sedes.nombre,
								reservaAmbientes.aprobado,reservaAmbientes.dia_semana,reservaAmbientes.hora_inicio,
								reservaAmbientes.hora_fin

								from sedes

								inner join ambientes
								on sedes.id = ambientes.id_sedes

								inner join reservaAmbientes
								on ambientes.id = reservaAmbientes.id_ambiente

								where reservaAmbientes.aprobado='si'&& sedes.id ='$sede' 
								ORDER BY ambientes.id";

				$retornoconsultasql = mysql_query($consultasql) or die ("resultado3= ".mysql_error());

					echo "<table id='resultado'>";  
				echo "<tr id='titulos'>";  
					echo "<th>-id ambiente-</th>";  
					echo "<th>-nombre-</th>";  
					echo "<th>-descripcion-</th>"; 
					echo "<th>-telefono-</th>"; 
					echo "<th>-nombre sede-</th>";  
					echo "<th>-aprobado-</th>";
					echo "<th>-dia de la semana-</th>";
					echo "<th>-hora inicio-</th>";
					echo "<th>-hora fin-</th>";

					
					
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

				if ($retornoconsultasql == true){
						echo "<p id='mensaje'>Exitoso</p>";
					}
					mysql_close($conexion_base_de_datos);
			}							

			 if(isset($_POST['buscar']))
			{
			    ejecutar3();
			}
//--------------------- registrar eliminar
			
			function ejecutar4(){

				$id_instructor=$_POST["id_instructor"];
							
				$host = "localhost"; 
				$user = "root";
				$pass = "";
				$bbdd = "gestionHorarios";

				$conexion_base_de_datos = mysql_connect($host,$user,$pass) or die("resultado1= ".urlencode(mysql_error())); 
				mysql_select_db($bbdd,$conexion_base_de_datos) or die("resultado2= ".urlencode(mysql_error()));
				$consultasql = "select  
								
								reservaAmbientes.id,reservaAmbientes.fecha_inicio,reservaAmbientes.fecha_fin,
								reservaAmbientes.dia_semana,reservaAmbientes.hora_inicio,
								reservaAmbientes.hora_fin, ambientes.nombre, sedes.nombre

								from reservaAmbientes

								inner join ambientes
								on reservaAmbientes.id_ambiente = ambientes.id

								inner join sedes
								on ambientes.id_sedes = sedes.id

								where id_instructor='$id_instructor' && aprobado='no'";
				$retornoconsultasql = mysql_query($consultasql) or die ("resultado3= ".mysql_error());

					echo "<table id='resultado'>";  
				echo "<tr id='titulos'>";  
					echo "<th>-id-</th>";  
					echo "<th>-fecha inicio-</th>";  
					echo "<th>-fecha fin-</th>"; 
					echo "<th>-dia de la semana-</th>"; 
					echo "<th>-hora inicio-</th>";  
					echo "<th>-hora fin-</th>";
					echo "<th>-nombre ambiente-</th>";
					echo "<th>-sede-</th>";
					

					
					
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
					   
					    
					
					    
					    echo "</tr>";  
					}  
					echo "</table>";  




				if ($retornoconsultasql == true){
						echo "<p id='mensaje'>Exitoso</p>";
					}
					mysql_close($conexion_base_de_datos);

				echo '<form action="solicita_reserva.php" method="post" id="for3">
					
							id: <input type="number" name="id"><br />
						    						     						    		   
						    <input type="submit" name="eliminar" value="Eliminar" />
						</form>
					';

			}							

			 if(isset($_POST['cancelar']))
			{
			    ejecutar4();
			}
//--------------------------- funcion eliminar2

			function ejecutar5()
			{
				$id=$_POST["id"];
				
				$host = "localhost"; 
				$user = "root";
				$pass = "";
				$bbdd = "gestionHorarios";

				$conexion_base_de_datos = mysql_connect($host,$user,$pass) or die("resultado1= ".urlencode(mysql_error())); 
				mysql_select_db($bbdd,$conexion_base_de_datos) or die("resultado2= ".urlencode(mysql_error()));
				$consultasql = "delete from reservaAmbientes where id='$id' && aprobado='no'";
				$retornoconsultasql = mysql_query($consultasql) or die ("resultado3= ".mysql_error());

				if ($retornoconsultasql == true){
						echo "<p id='mensaje'>Exitoso</p>";
					}
					mysql_close($conexion_base_de_datos);

			}

			if(isset($_POST['eliminar']))
			{
			    ejecutar5();
			}

		?>
	</body>
</html>
<?php
	}
?>