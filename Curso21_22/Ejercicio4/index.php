<?php

/*Como llamo a esas variabls, primero las inicializo a false para la vez en la que abrimos por primera vez el archivo*/

$err_nombre = false;
$err_apellidos = false;
$err_pass = false;
$err_dni = false;
$err_comentarios = false;
$err_sexo = false;


//para borrar todos los campos

/* Realmente lo que hacemos es quitar que sea un tipo reset, 
que sea submint y si se pulsa (isset) pues recargamos la 
pagina redirigiendola a la misma*/
if (isset($_POST["borrar"])){
    header ("Location:index.php");
    exit;
}

/*Primero vemos que se haya pulsado el bootn de enviar*/
if (isset($_POST["enviar"])) {



    //comprobamos los errores
    $err_nombre = $_POST["nombre"] == "";
    $err_apellidos = $_POST["apellidos"] == "";
    $err_pass = $_POST["pass"] == "";
    $err_dni = $_POST["dni"] == "";
    $err_comentarios = $_POST["cometarios"] == "";
    $err_sexo = !isset($_POST["sexo"]); //al ser un boton, con solamente preguntar si esta instanciado se sabe si se ha pulsado o no

    //lo asociamos en una sola variable
    $errores = ($err_nombre | $err_apellidos | $err_pass | $err_dni | $err_sexo | $err_comentarios);
}

//si se pulsa y no hay errores, mostramos el resultado de lo recibido con sus valores correspondientes
if (isset($_POST["enviar"]) && !$errores) {

    echo "<h3>Datos recibidos:</h3>";

    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $pass = $_POST["pass"];
    $dni = $_POST["dni"];
    $comentarios = $_POST["cometarios"];

    echo "<p><strong>Nombre: </strong>" . $nombre . "</p>";
    echo "<p><strong>Apellidos: </strong>" . $apellidos . "</p>";
    echo "<p><strong>Contraseña: </strong>" . $pass . "</p>";
    echo "<p><strong>DNI: </strong>" . $dni . "</p>";

    if (isset($_POST["sexo"])) {
        $sexo = $_POST["sexo"];
        echo "<p><strong>Sexo: </strong>" . $sexo . "</p>";
    }
    if (isset($_POST["subs"])) {
        echo "<p>Si ";
    } else {
        echo "<p>No ";
    };

    echo "esta suscrito </p>";

    echo "<p>Comentarios: " . $comentarios . "</p>";

    //sino mostramos la pagina de nuevo
} else {
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

            <input type="submit" name="enviar" value="Guardar cambios" />
            <input type="submit" name="borrar" value="Borrar cambios" />
        </form>

    </body>

    </html>
<?php

}

?>