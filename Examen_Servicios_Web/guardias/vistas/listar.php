<?php require_once "src/seguridad.php"; ?>
<h3>Bienvenido <?php echo $_SESSION['usuario'] ?> - <form action="" method="post"><button type="submit" name="salir">Salir</button></form>
</h3>

<table border="1" style="text-align: center;">

    <tr>
        <th></th>
        <th>LUNES</th>
        <th>MARTES</th>
        <th>MIERCOLES</th>
        <th>JUEVES</th>
        <th>VIERNES</th>
    </tr>

    <?php

    $horas = ["", "8:15 - 9:15", "9:15 - 10:15", "10:15 - 11:15", "11:15 - 11:45", "11:45 - 12:45", "12:45 - 13:45", "13:45 - 14:45"];


    $equipo = 1;

    for ($i = 1; $i < 8; $i++) {
        echo "<tr>";

        if ($i == 4) {
            echo "<td>$horas[$i]</td>";
            echo "<td colspan='5'>RECREO</td>";
        } else {
            for ($j = 0; $j < 6; $j++) {

                if ($j == 0) {
                    echo "<td>$horas[$i]</td>";
                } else {
                    echo "<td><form method='post'><button name='listar' value='$equipo'>EQUIPO $equipo</button>
                    <input type='hidden' name='hora' value='$i' />
                    <input type='hidden' name='dia' value='$j' />
                    </form></td>";

                    $equipo++;
                }
            }
        }

        echo "</tr>";
    }
    ?>
</table>

<?php
if (isset($_POST['listar']) || isset($_POST['profesor'])) {

    echo "<h3>EQUIPO DE GUARDIA " . $_POST['listar'] . " </h3>";
    $dia = ["", 'LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES'];

    $hora = $_POST['hora'];

    if ($_POST['hora'] > 3) {

        $hora = $_POST['hora'] - 1;
    }


    echo "<h4>" . $dia[$_POST['dia']] . " a $hora ª hora</h4>";

    $id = '';

    if (isset($_POST['profesor'])) {

        $id = $_POST['profesor'];
    }

    $url = DIR_SERV . "/usuarioGuardia/" . $_POST['dia'] . "/" . $_POST['hora'];
    $respuesta = consumir_servicios_REST($url, "get");

    $obj = json_decode($respuesta);

    if (!$obj) {
        session_destroy();
        die("<p>Error al consumir el servicio $url <br /> $respuesta </p></body></html>");
        exit;
    }

    if (isset($obj->error)) {
        session_destroy();
        die("<p>$obj->error</p></body></html>");
        exit;
    }

    $primero = true;

    echo "<table border='1'>";
    echo "<tr> <th>Profesores de Guardia</th> <th>informacion del profesor con id: $id</th> </tr>";

    foreach ($obj->usuario as $profesor) {

        echo "<tr>";
        echo "<td><form index='index.php' method='post'>
        <input type='hidden' name='hora' value='" . $_POST['hora'] . "'>
        <input type='hidden' name='dia' value='" . $_POST['dia'] . "'>
        <input type='hidden' name='listar' value='" . $_POST['listar'] . "'>
        <button name='profesor' value='$profesor->usuario'>$profesor->nombre</button></form></td>";

        if ($primero) {

            if (isset($_POST['profesor'])) {

                $url .= "/" . $_POST['profesor'];

                $respuesta = consumir_servicios_REST($url, "get");
                $profe = json_decode($respuesta);

                if (!$profe) {
                    session_destroy();
                    die("<td rowspan='$obj->cantidad'> Error al consumir el servicio $url <br /> $respuesta</td></tr></table></body></html>");
                    exit;
                }

                if (isset($profe->error)) {
                    session_destroy();
                    die("<td rowspan='$obj->cantidad'>$profe->error</td></tr></table></body></html>");
                    exit;
                }

                if (isset($profe->mensaje)) {
                    session_destroy();
                    die("<td rowspan='$obj->cantidad'>$profe->mensaje</td></tr></table></body></html>");
                    exit;
                }

                echo "<td rowspan='$obj->cantidad'>
                <p>Nombre:" . $profe->usuario->nombre . "</p>
                <p>Usuario: " . $profe->usuario->usuario . "</p>
                <p>Contraseña: </p>";
                if ($profe->usuario->email == null) {
                    echo "<p>Email: null</p>";
                } else {
                    echo "<p>Email: " . $profe->usuario->email . "</p>";
                }
                echo "</td>";
            } else {
                echo "<td rowspan='$obj->cantidad'></td>";
            }
            $primero = false;
        }

        echo "</tr>";
    }

    echo "</table>";
}
?>