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
			    top: 140px;
			    left: 50px;		    
			}
			#links1 td {
				border: 1px solid blue;			    
			    padding-left: 5%;
			    background-color: white;}

			#for3 {
					position:absolute;
					color: white;
					width: 19%;
					top: 265px;
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
		<h1>Inicio Instructores</h1>

		<table id="links1">
			
			<tr>
				<td><a href="i_solicita_prestamo.php">Solicitar Prestamo de Inventario</a></td>
			</tr>
			<tr>
				<td><a href="solicita_reserva.php">Solicitar Reserva de Ambiente</a></td>
			</tr>
			<tr>
				<td><a href="cerrar.php">Cerrar Sesion</a> </td>
			</tr>
		</table>


		<form action="instructor.php" method="post" id="for3">
			
		    id (ej: 1118291792): <input type="number" name="id"  /><br />
		    	    		   
		    <input type="submit" name="submit1" value="Consultar Horario" />
		</form>

		<?php

			
			function ejecutar1()
			{
				$id=$_POST["id"];
				
				$host = "localhost"; 
				$user = "root";
				$pass = "";
				$bbdd = "gestionHorarios";

				$conexion_base_de_datos = mysql_connect($host,$user,$pass) or die("resultado1= ".urlencode(mysql_error())); 
				mysql_select_db($bbdd,$conexion_base_de_datos) or die("resultado2= ".urlencode(mysql_error()));
				$consultasql = "select instructores.id, sedes.nombre, ambientes.nombre, reservaAmbientes.dia_semana,
								reservaAmbientes.hora_inicio, reservaAmbientes.hora_fin, grupos.nombre,
								reservaAmbientes.fecha_inicio, reservaAmbientes.fecha_fin
								
								from instructores
								
								inner join reservaAmbientes
								on instructores.id = reservaAmbientes.id_instructor
								
								inner join grupos
								on reservaAmbientes.id_grupo = grupos.id

								inner join ambientes
								on reservaAmbientes.id_ambiente = ambientes.id

								inner join sedes
								on ambientes.id_sedes = sedes.id

								where instructores.id ='$id'";
				$retornoconsultasql = mysql_query($consultasql) or die ("resultado3= ".mysql_error());

				echo "<table id='resultado1'>";  
				echo "<tr id='titulos1'>";  
				echo "<th>-id instructor-</th>";  
				echo "<th>-sede-</th>"; 
				echo "<th>-ambiente-</th>"; 
				echo "<th>-dia-</th>"; 
				echo "<th>-hora inicio-</th>"; 
				echo "<th>-hora fin-</th>";
				echo "<th>-grupo-</th>"; 
				echo "<th>-fehca_inicio-</th>"; 
				echo "<th>-fecha_fin-</th>";  
				
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

			 if(isset($_POST['submit1']))
			{
			    ejecutar1();
			}


		?>		

	</body>
</html>
<?php
	}
?>