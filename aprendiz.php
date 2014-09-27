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
				    top: 140px;
				    left: 50px;				    
				}
				#links1 td {
					border: 1px solid blue;			    
				    padding-left: 5%;
				    background-color: white;
				}
				 #for3 {
					position:absolute;
					color: white;
					width: 19%;
					top: 180px;
					left: 50px;
					text-transform: capitalize;
					font-size: 16px;
					text-shadow: 2px 2px 8px black;					    			    
				}
				#for3 input{				
					width: 100%;							    			    
				}
				#resultado1 {
					position:absolute;
					top: 140px;
					left: 25%;
					text-align: center;
					width: 73%;
					color: white;
					font-size: 16px;				    			    
				}
				#resultado1 #titulos1{
					text-transform: capitalize;
					background: #0489B1;							    			    
				}

				#resultado1 #datos1{					
					background: #5858FA;							    			    
				}

				#resultado1 td, th{
					border: 1px solid white;
				}				
		</style> 

	</head>
	<body>
		<h1>Consultar Horario</h1>
		
		
		<table id="links1">
			<tr>
				<td><a href="index.php">inicio</a> </td>
			</tr>
		</table>
		<br>

		<form action="aprendiz.php" method="post" id="for3">
			
		    Grupo (ej: tps41): <input type="text" name="grupo"  /><br />
		    	    		   
		    <input type="submit" name="submit1" value="Consultar" />
		</form>

		<?php

			$grupo;					

			 if(isset($_POST['submit1']))
			{
			    ejecutar1();
			}

			function ejecutar1()
			{
				$grupo=$_POST["grupo"];
				
				$host = "localhost"; 
				$user = "root";
				$pass = "";
				$bbdd = "gestionHorarios";

				$conexion_base_de_datos = mysql_connect($host,$user,$pass) or die("resultado1= ".urlencode(mysql_error())); 
				mysql_select_db($bbdd,$conexion_base_de_datos) or die("resultado2= ".urlencode(mysql_error()));
				$consultasql = "select grupos.nombre, reservaAmbientes.fecha_inicio, reservaAmbientes.fecha_fin,
								reservaAmbientes.hora_inicio, reservaAmbientes.hora_fin, reservaAmbientes.dia_semana, ambientes.nombre,
								instructores.nombre, sedes.nombre

								from reservaAmbientes
								inner join grupos
								on reservaAmbientes.id_grupo = grupos.id

								inner join ambientes
								on reservaAmbientes.id_ambiente = ambientes.id

								inner join sedes 
								on ambientes.id_sedes = sedes.id

								inner join instructores
								on reservaAmbientes.id_instructor = instructores.id

								where grupos.nombre ='$grupo'";
				$retornoconsultasql = mysql_query($consultasql) or die ("resultado3= ".mysql_error());

				echo "<table id='resultado1'>";  
				echo "<tr id='titulos1'>";  
				echo "<th>-Nombre Grupo-</th>";  
				echo "<th>-Inico Horario-</th>";  
				echo "<th>-Fin Horario-</th>"; 
				echo "<th>-Hora Inicio-</th>"; 
				echo "<th>-Hora Fin-</th>";  
				echo "<th>-dia de la semana-</th>";
				echo "<th>-Nombre Ambiente-</th>";
				echo "<th>-Nombre instructor-</th>";
				echo "<th>-nombre sedes-</th>";
				echo "</tr>";  
				while ($recorre = mysql_fetch_row($retornoconsultasql)){   
				    echo "<tr id='datos1'>";  
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

			}

		?>		
	</body>
</html>