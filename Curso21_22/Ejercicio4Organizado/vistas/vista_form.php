<?php

/*
Como llamo a esas variables en el codigo html, primero 
las inicializo a false para la vez en la que abrimos 
por primera vez el archivo no salte un error
*/

$err_nombre = false;
$err_apellidos = false;
$err_pass = false;
$err_dni = false;
$err_comentarios = false;
$err_sexo = false;


if (isset($_POST["enviar"])) {



    //comprobamos los errores
    $err_nombre = $_POST["nombre"] == "";
    $err_apellidos = $_POST["apellidos"] == "";
    $err_pass = $_POST["pass"] == "";
    $err_dni = $_POST["dni"] == "";
    $err_comentarios = $_POST["cometarios"] == "";
    $err_sexo = !isset($_POST["sexo"]); //al ser un boton, con solamente preguntar si esta instanciado se sabe si se ha pulsado o no


}

?>

<!DOCTYPE html>

<html>

<head>
    <title>Ejercicio3</title>
    <meta charset="UTF-8" />
</head>

<body>

    <h3>Rellena tu CV</h3>

    <form action="index.php" method="post" enctype="multipart/form-data">

        <label for="name">Nombre</label><br /> <!-- Si hay algo tecleado en el campo, que lo mantenga el campo -->
        <input type="text" name="nombre" id="name" value="<?php if (isset($_POST["nombre"])) echo $_POST["nombre"] ?>" />

        <!-- ahora vemos si el campo esta vacio y si lo esta marcamos que este campo es obligatorio -->
        <?php
        if ($err_nombre) {
            echo "<label color='red'>*Campo obligatorio*</label>";
        }
        ?>

        <br />

        <label for="surname">Apellidos</label><br />
        <input type="text" size="50" name="apellidos" id="surname" value="<?php if (isset($_POST["apellidos"])) echo $_POST["apellidos"] ?>" />

        <?php
        if ($err_apellidos) {
            echo "<label color='red'>*Campo obligatorio*</label>";
        }
        ?>

        <br />

        <label for="contra">Contraseña</label><br />
        <input type="password" size="10" name="pass" id="contra" value="" />

        <?php
        if ($err_pass) {
            echo "<label color='red'>*Campo obligatorio*</label>";
        }
        ?>

        <br />

        <label for="dni">DNI</label><br />
        <input type="text" size="10" name="dni" id="dni" value="<?php if (isset($_POST["dni"])) echo $_POST["dni"] ?>" />

        <?php
        if ($err_dni) {
            echo "<label color='red'>*Campo obligatorio*</label>";
        }
        ?>

        <br />
        <br />

        <label>Sexo</label>
        <?php
        if ($err_sexo) {
            echo "<label color='red'>*Campo obligatorio*</label>";
        }
        ?>
        <br />

        <input type="radio" name="sexo" id="hombre" value="Hombre" <?php if (isset($_POST["sexo"]) && ($_POST["sexo"] == "Hombre")) echo "checked" ?> />
        <label for="hombre">Hombre</label>

        <br />

        <input type="radio" name="sexo" id="mujer" value="Mujer" <?php if (isset($_POST["sexo"]) && ($_POST["sexo"] == "Mujer")) echo "checked" ?> />
        <label for="mujer">Mujer</label>

        <br />
        <br />

        <label for="foto">Incluir mi foto</label>
        <input type="file" name="foto" id="foto" accept="image/*">

        <br />
        <br />

        <input type="checkbox" name="subs" id="subs" <?php if (isset($_POST["subs"]) | !isset($_POST["enviar"])) echo "checked" ?>>
        <label for="subs">Suscribirse al boletin de Novedades</label>

        <br />
        <br />

        <table>
            <tr>
                <td>
                    <label for="comentarios">Comentarios:</label>
                </td>

                <td>
                    <!-- Al ser un tex area, dentro del contenido se escribe lo que contenga, si se ha escrito algo -->
                    <textarea name="cometarios" id="comentarios" cols="30" rows="5">
                            <?php if (isset($_POST["cometarios"])) echo $_POST["cometarios"] ?>
                        </textarea>

                    <?php
                    if ($err_comentarios) {
                        echo "*Campo obligatorio*";
                    }
                    ?>
                </td>
            </tr>
        </table>

        <br />
        <br />

        <label for="nacimiento">Nacido en:</label>
        <select name="nacimiento" id="nacimiento">
            <optgroup label="España">
                <option value="malaga" <?php if (isset($_POST["nacimiento"]) && ($_POST["nacimiento"] == "malaga")) echo "selected" ?>>Málaga</option>
                <option value="cadiz" <?php if (isset($_POST["nacimiento"]) && ($_POST["nacimiento"] == "cadiz")) echo "selected" ?>>Cádiz</option>
            </optgroup>
            <optgroup label="Francia">
                <option value="paris" <?php if (isset($_POST["nacimiento"]) && ($_POST["nacimiento"] == "paris")) echo "selected" ?>>París</option>
                <option value="normandia" <?php if (isset($_POST["nacimiento"]) && ($_POST["nacimiento"] == "normandia")) echo "selected" ?>>Normandia</option>
            </optgroup>
        </select>

        <br />
        <br />
        <br />

        <input type="submit" name="enviar" value="Guardar cambios" />
        <input type="submit" name="borrar" value="Borrar cambios" />
    </form>

</body>

</html>