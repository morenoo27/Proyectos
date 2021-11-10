<?php
require "src/config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primer CRUD</title>
    <style>
        .centrar {
            text-align: center;
        }

        table tr td img {
            height: 30px;
            width: 30px;
        }

        table,
        tr,
        th,
        td {
            border: 1px solid black;
        }

        table {
            border-collapse: collapse;
            width: 60%;
            margin: 0 auto;
        }

        .centarFormulario {
            width: 60%;
            margin: 1.5rem auto;
        }
    </style>
</head>

<body>
    <h1 class="centrar">Listado de usuarios</h1>


    <?php
    @$conexion = mysqli_connect(SERVIDOR_BD, NOMBRE_USUARIO, CLAVE, NOMBRE_BD);
    if (!$conexion) {

        die("<p>Imposible conectar. Error número: " . mysqli_connect_errno() .
            " : " . mysqli_connect_error() . "</p></body></html>");
    }

    mysqli_set_charset($conexion, "utf8");

    $consulta = "select * from usuarios";
    $resultado = mysqli_query($conexion, $consulta);
    ?>

    <table>
        <tr>
            <th>Nombre de ususario</th>
            <th>Borrar</th>
            <th>Editar</th>
        </tr>
        <?php
        if ($resultado) {
            while ($datos = mysqli_fetch_assoc($resultado)) {

                echo "<tr>";
                echo "<td class='centrar'>" . $datos["nombre"] . "</td>";
                echo "<td class='centrar'><img src='imagenes/borrar.jpg' alt='borrar.jpg'></td>";
                echo "<td class='centrar'><img src='imagenes/editar.png' alt='editar.png'></td>";
                echo "</tr>";
            }
        } else {

            $error = "<p>Imposible realizar la consulta. Error número: "
                . mysqli_errno($conexion) . " : " . mysqli_error($conexion) . "</p>";
            mysqli_close($conexion);
            die($error);
        }
        ?>
    </table>
    <form class="centarFormulario" action="usuario_nuevo.php" method="post">
        <button type="submit">Insertar nuevo usuario</button>
    </form>
</body>

</html>