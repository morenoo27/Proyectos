<!DOCTYPE html>

<html>

<head>
	<title>Ejemplo de Formulario</title>
	<meta charset="UTF-8" />
</head>

<body>

	<h3>Rellena tu CV</h3>

	<form action="recepcion_datos.php" method="post" enctype="multipart/form-data">

		<label for="name">Nombre</label><br />
		<input type="text" name="nombre" id="name" />

		<br />

		<label for="surname">Apellidos</label><br />
		<input type="text" size="50" name="apellidos" id="surname" />

		<br />

		<label for="contra">Contraseña</label><br />
		<input type="password" size="10" name="pass" id="contra" />

		<br />

		<label for="dni">DNI</label><br />
		<input type="text" size="10" name="dni" id="dni" />

		<br />
		<br />

		<input type="radio" name="sexo" id="hombre" value="Hombre" />
		<label for="hombre">Hombre</label>

		<br />

		<input type="radio" name="sexo" id="mujer" value="Mujer" />
		<label for="mujer">Mujer</label>

		<br />
		<br />

		<label for="foto">Incluir mi foto</label>
		<input type="file" name="foto" id="foto" accept="image/*">

		<br />
		<br />

		<input type="checkbox" name="subs" id="subs" checked>
		<label for="subs">Suscribirse al boletin de Novedades</label>

		<br />
		<br />

		<table>
			<tr>
				<td>
					<label for="comentarios">Comentarios:</label>
				</td>

				<td>
					<textarea name="cometarios" id="comentarios" cols="30" rows="5"></textarea>
				</td>
			</tr>
		</table>

		<br />
		<br />

		<label for="nacimiento">Nacido en:</label>
		<select name="nacimiento" id="nacimiento">
			<optgroup value="Espana">
				<option value="malaga">Málaga</option>
				<option value="cadiz">Cádiz</option>
			</optgroup>
			<optgroup value="Francia">
				<option value="paris">París</option>
				<option value="normandia">Normandia</option>
			</optgroup>
		</select>

		<br />
		<br />
		<br />

		<input type="submit" value="Guardar cambios" />
	</form>
</body>

</html>