<?php 

	if(!isset($_POST["nombre"])){ 
		/*si rellenas el formulario y tiene campos de textos,
		aunque esten vacion estan inicializados, por eso es 
		bueno comprobarlo con un .....campo de tipo texto......*/
		
		header("Location:index.php");
		/*RECOMENDABLE HACERLO SIEMPRE ANTES DE CUALQUEIR ESCRITURA DE HTML*/
		
		//despues de un header, un exit SIEMPRE
		exit;//similar a un break;
	}
?>

<!DOCTYPE html>

<html>
	<head>
		<title>Ejemplo de Formulario</title>
		<meta charset="UTF-8"/>
	</head>
	<body>
	
		<h3>Datos recibidos</h3>
		
		<?php
			
			$nombre=$_POST["nombre"];
			$apellidos=$_POST["apellidos"];
			$pass=$_POST["pass"];
			$dni=$_POST["dni"];
			
			echo "<p><strong>Nombre: </strong>".$nombre."</p>";
			echo "<p><strong>Apellidos: </strong>".$apellidos."</p>";
			echo "<p><strong>Contraseña: </strong>".$pass."</p>";
			echo "<p><strong>DNI: </strong>".$dni."</p>";
		
			if(isset($_POST["sexo"])){
				$sexo = $_POST["sexo"];
				echo "<p><strong>Sexo: </strong>".$sexo."</p>";
			}

			if(isset($_POST["subs"])){
				echo "<p>Si ";
			} else {
				echo "<p>No ";
			};

			echo "esta suscrito </p>";

		?>
	</body>
</html>
