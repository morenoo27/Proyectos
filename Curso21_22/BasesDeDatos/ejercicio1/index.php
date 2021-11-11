<?php

require "funciones.php";
require "src/config.php";

//establecemos conexion al principio de todo
@$conexion = mysqli_connect(SERVIDOR_BD, NOMBRE_USUARIO, CLAVE, NOMBRE_BD);
if (!$conexion)
    die(error_page("Primer CRUD - Index", "<h2>Listado de Usuarios</h2><p>Error en la conexión Nº: " . mysqli_connect_errno() . " : " . mysqli_connect_error() . "</p>"));

mysqli_set_charset($conexion, "utf8");

//seccion para la confirmacion del borrado del usuario
if (isset($_POST["btnContinuarBorrado"])) {

    $consulta = "delete from usuarios where id_usuario = " . $_POST["btnContinuarBorrar"];
    $resultado = mysqli_query($conexion, $consulta);
    if ($resultado) {

        $accion = "El usuario seleccionado ha sido borrado con éxito";
    } else {

        $body = "<h2>Listado de Usuarios</h2><p>Error en la consulta Nº: " . mysqli_connect_errno() . " : " . mysqli_connect_error() . "</p>";
        mysqli_close($conexion);
        die(error_page("Primer CRUD - Index", $body));
    }
}

if (isset($_POST["insertado"]))
    $accion = "Usuario insertado con éxito";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primer CRUD - Index</title>
    <style>
        * {
            color: black;
            font-size: 14px;
            font-family: 'Open Sans', "sans-serif";
        }

        table tr td img {
            height: 30px;
            width: 30px;
        }

        .centrar {
            text-align: center
        }

        .form_nuevo,
        .mensaje,
        .datos {
            width: 60%;
            margin: 1.5em auto;
        }

        table,
        th,
        td {
            border: 1px solid black
        }

        table {
            border-collapse: collapse;
            width: 60%;
            margin: 0 auto
        }

        .sin_boton {
            background: transparent;
            border: none;
            color: blue;
            text-decoration: underline;
            cursor: pointer
        }
    </style>
</head>

<body>
    <h1 class="centrar">Listado de los Usuarios</h1>

    <?php

    $consulta = "select * from usuarios";

    $resultado = mysqli_query($conexion, $consulta);
    if ($resultado) {
        echo "<table class='centrar'><tr><th>Nombre de Usuario</th><th>Borrar</th><th>Editar</th></tr>";

        while ($datos = mysqli_fetch_assoc($resultado)) {
            echo "<tr>";
            echo "<td><form action='index.php' method='post'><button class='sin_boton' title='Detalle Usuario' name='btnListar' value='" . $datos["id_usuario"] . "'>" . $datos["nombre"] . "</button></form></td>";
            echo "<td><form action='index.php' method='post'><input type='hidden' name='nombreBorrar' value='" . $datos["nombre"] . "'/><button class='sin_boton' title='Borrar Usuario' name='btnBorrar' value='" . $datos["id_usuario"] . "'><img src='imagenes/borrar.jpg' title='Borrar Usuario' alt='Borrar'/></button></form></td>";
            echo "<td><img src='imagenes/editar.png' title='Editar Usuario' alt='Editar'/></td>";
            echo "</tr>";
        }
        echo "</table>";
        mysqli_free_result($resultado);

        if (isset($accion))
            echo "<p class='mensaje'>" . $accion . "</p>";

        switch ($_POST) {

                /*ERROR CORREGIDO: Si se usa un switch, y pulsas el boton cancelar(que solo vuelve(de ahi el nombre $_POST["vuelve"]))
            sigue existiendo el boton de borrar o cualqueir otro. Por lo tanto se controla identificando si se ha pulsado o no
            dicho boton para asi saltar al caso base (default)
            */
            case isset($_POST["btnBorrar"]):

                if (!isset($_POST["vuelve"])) {

                    echo "<div class='datos'>";
                    echo "<h2>Borrado del usuario " . $_POST["btnBorrar"] . "</h2>";
                    echo "<form action='index.php' method='post'>";
                    echo "<p>Se dispone a borrar al usuario <b> " . $_POST["nombreBorrar"] . "</b></p>";
                    echo "<p><button type='submit' name='btnContinuarBorrado' value='" . $_POST["btnBorrar"] . "'>Continuar</button>&nbsp;&nbsp;<input type='submit' name='vuelve' value='Cancelar'/></p>";
                    echo "</form>";
                    echo "</div>";
                    break;
                }

            case isset($_POST["btnListar"]):
                $consulta = "select * from usuarios where id_usuario = " . $_POST["btnListar"];
                $resultado = mysqli_query($conexion, $consulta);
                if ($resultado) {

                    if ($datos = mysqli_fetch_assoc($resultado)) {

                        echo "<div class='datos'>";
                        echo "<h2>Listado del usuario " . $datos["id_usuario"] . "</h2>";
                        echo "<p><b>Nombre:</b> " . $datos["nombre"] . "</p>";
                        echo "<p><b>Usuario:</b> " . $datos["usuario"] . "</p>";
                        echo "<p><b>Email:</b> " . $datos["email"] . "</p>";
                        echo "<form><p><button type='submit' formaction='index.php'>Volver</button></p></form>";
                        echo "</div>";
                    } else {

                        echo "<p class='datos'>El ususario seleccionado ya no se encuentra en la Base de Datos</p>";
                    }
                    mysqli_free_result($resultado);
                }

                if (!$conexion) {
                    die("<p>Error en la conexión Nº: " . mysqli_connect_errno() . " : " . mysqli_connect_error() . "</p></body></html>");
                    mysqli_close($conexion);
                }
                break;

            default:
                echo '<form class="form_nuevo" action="usuario_nuevo.php" method="post">';
                echo '<input type="submit" name="btnNuevo" value="Insertar nuevo Usuario" />';
                echo '</form>';
                break;
        }
    } else {
        $error = "<p>Error en la consulta Nº: " . mysqli_errno($conexion) . " : " . mysqli_error($conexion) . "</p></body></html>";
        mysqli_close($conexion);
        die($error);
    }

    ?>

</body>

</html>