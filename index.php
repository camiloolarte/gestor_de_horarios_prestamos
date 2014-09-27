<?php
	
if (isset($_GET['resp'])) {

		if($_GET["resp"] == "noInstructor"){
			echo "<font color='white'>ERROR NO INICIO SESION COMO INSTRUCTOR</font>";
		}else if($_GET["resp"] == "cerrado"){
			echo "<font color='white'>SESION CERRADA CORRECTAMENTE</font>";
		}else if($_GET["resp"] == "noAdmin"){
			echo "<font color='white'>ERROR NO INICIO SESION COMO ADMINISTRADOR</font>";
		}
	}
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Gestion de Horarios</title>
		
		<style type="text/css"> 

			body { 

				background:url(img/fondo.jpg);
				background-size: 100% 100%; }


				#links {
					text-transform: capitalize;
					font-size: 16px;
					position:absolute;
				    width: 20%;
				    top: 140px;
				    left: 50px;
				     
				    
				}			

				#links td {

					border: 1px solid blue;			    
				    padding-left: 5%;
				    background-color: white;

				}


				#for2 {

					position:absolute;
					color: white;
					width: 19%;
					top: 180px;
					left: 50px;
					text-transform: capitalize;
					font-size: 16px;
					text-shadow: 2px 2px 8px black;					

				    			    
				}

				#for2 input{				
					width: 100%;
							    			    
				}


				a:link {
				    text-decoration: none;
				}

				a:visited {
				    text-decoration: none;
				}

				a:hover {
					color: #FF00FF;
				    text-decoration: underline;
				}

				a:active {
					color: #0000FF;
				    text-decoration: underline;
				}

				h1 {
					position:relative;			   
				    top: 6%;
				  	
				    color: #FBEFEF;
				    text-align: center;
				    text-shadow: 2px 2px 8px #FFFFFF;
				}

				
		</style> 

	</head>
	<body>	

		<form action='validacion.php' method='POST' id="for2">
			Usuario <input type="text" name="usuario" >
			contrasena <input type="password" name="contrasena">

			<input type="submit" name="login" value="Iniciar sesion">
		</form>

		
		<h1>Gestor de Horarios y Prestamos de Inventario para Instituciones Educativas</h1>
		<table id="links">
			<tr>
				<td><a href="aprendiz.php">Consultar Horario Aprendiz</a></td>
			</tr>
		</table>
	</body>
</html>