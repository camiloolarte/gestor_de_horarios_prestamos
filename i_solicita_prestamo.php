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
		<h1>Prestamos de Inventario</h1>
		<table id="links1">
			<tr>
				<td><a href="instructor.php">inicio</a></td>
			</tr>
			<tr>
				<td><a href="solicita_reserva.php">solicitud de reserva ambiente</a></td>
			</tr>
			<tr>
				<td><a href="cerrar.php">cerrar sesion</a> </td>
			</tr>			
		</table>
		<table id="for1">
			<form action="i_solicita_prestamo.php" method="post" >
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
				$consultasql = "select *  from prestamoInventario 
				where aprobado='si'";
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
				echo "<th>-nombre-</th>";
				echo "<th>-id instructor-</th>";
				echo "<th>-probado-</th>";
				
								
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

					echo '<form action="i_solicita_prestamo.php" method="post" id="for3">

						    tipo: <input type="text" name="tipo"><br />
						    id_inventario: <input type="number" name="id_inventario"><br />
						    cantidad: <input type="number" name="cantidad"><br />
						    fecha: <input type="date" name="fecha"><br />
						    hora inicio: <input type="time" name="hora_inicio"><br />
						    hora fin: <input type="time" name="hora_fin"><br />
						    nombre: <input type="text" name="nombre"><br />
						    id_instructor: <input type="int" name="id_instructor"><br />
						   

						    <input type="submit" name="registrar" value="Solicitar" />
						</form>';
				} elseif ($decide == "buscar") {
					echo '<form action="i_solicita_prestamo.php" method="post" id="for3">

							tipo equipo: <input type="text" name="tipo"><br />
							sede: <input type="text" name="sede"><br />
						    						     						    		   
						    <input type="submit" name="buscar" value="Buscar" />
						</form>';
				}elseif ($decide == "cancelar") {
					echo '<form action="i_solicita_prestamo.php" method="post" id="for3">
					
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

				$host = "localhost"; 
				$user = "root";
				$pass = "";
				$bbdd = "gestionHorarios";

				$conexion_base_de_datos = mysql_connect($host,$user,$pass) or die("resultado1= ".urlencode(mysql_error())); 
				mysql_select_db($bbdd,$conexion_base_de_datos) or die("resultado2= ".urlencode(mysql_error()));
				$consultasql = "insert into prestamoInventario values
							('','$tipo','$id_inventario','$cantidad','$fecha','$hora_inicio','$hora_fin',
							'$nombre','$id_instructor','no')";
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
//--------------------------- funcion buscar

			function ejecutar3()
			{	
				$tipo=$_POST["tipo"];
				$sede=$_POST["sede"];
				

				$host = "localhost"; 
				$user = "root";
				$pass = "";
				$bbdd = "gestionHorarios";

				$conexion_base_de_datos = mysql_connect($host,$user,$pass) or die("resultado1= ".urlencode(mysql_error())); 
				mysql_select_db($bbdd,$conexion_base_de_datos) or die("resultado2= ".urlencode(mysql_error()));
				$consultasql = "select 

								inventario.id, inventario.cantidad, inventario.cantidad - prestamoInventario.cantidad,
								ambientes.nombre, sedes.nombre, ambientes.tipo
								
								from inventario

								inner join prestamoInventario
								on inventario.id = prestamoInventario.id_inventario

								inner join ambientes
								on inventario.id_ambiente = ambientes.id

								inner join sedes
								on ambientes.id_sedes = sedes.id


								where inventario.tipo ='$tipo' && sedes.nombre = '$sede' ";
				$retornoconsultasql = mysql_query($consultasql) or die ("resultado3= ".mysql_error());

				echo "<table id='resultado'>";  
				echo "<tr id='titulos'>";  
				echo "<th>-id inventario-</th>";  
				echo "<th>-en stock-</th>"; 
				echo "<th>-disponibles-</th>"; 
				echo "<th>-ambiente-</th>"; 
				echo "<th>-sede-</th>"; 
				echo "<th>-tipo ambiente-</th>"; 
				
								
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


				if ($retornoconsultasql == true){
					echo "<p id='mensaje'>Exitoso</p>";
				}
				mysql_close($conexion_base_de_datos);
			}

			if(isset($_POST['buscar']))
			{
			    ejecutar3();
			}
//--------------------------- funcion eliminar

			function ejecutar4()
			{
				$id_instructor=$_POST["id_instructor"];
				
				$host = "localhost"; 
				$user = "root";
				$pass = "";
				$bbdd = "gestionHorarios";

				$conexion_base_de_datos = mysql_connect($host,$user,$pass) or die("resultado1= ".urlencode(mysql_error())); 
				mysql_select_db($bbdd,$conexion_base_de_datos) or die("resultado2= ".urlencode(mysql_error()));
				$consultasql = "select *  from prestamoInventario 
				where id_instructor='$id_instructor' && aprobado='no'";
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
				echo "<th>-nombre-</th>";
				echo "<th>-id instructor-</th>";
				echo "<th>-probado-</th>";
				
								
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

				if ($retornoconsultasql == true){
					echo "<p id='mensaje'>Exitoso</p>";
				}
				mysql_close($conexion_base_de_datos);

				echo '<form action="i_solicita_prestamo.php" method="post" id="for3">
					
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
				$consultasql = "delate from prestamoInventario where id='$id' && aprobado='no'";
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