<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen4 PHP</title>
    <style>
        .enlace {
            border: none;
            background: none;
            text-decoration: underline;
            color: blue;
            cursor: pointer
        }

        .enlinea {
            display: inline
        }

        td {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Examen4 PHP</h1>
    <div>
        Bienvenido <strong><?php echo $_SESSION["usuario"]; ?></strong> - <form class="enlinea" method="post" action="index.php"><button class="enlace" name="btnCerrarSesion">Salir</button></form>
    </div>

    <?php
    $url = DIR_SERV . "/usuarios";
    $respuesta = consumir_servicios_REST($url, "GET");

    $obj = json_decode($respuesta);
    if (!$obj) {
        echo "Error al consumir el servicio $url. " . $respuesta;
    }

    if (isset($obj->error)) {
        echo $obj->error;
    } else {

        echo '<form action="index.php" method="post">';
        echo '<select name="profesor" id="profesor">';

        foreach ($obj->usuarios as $usuario) {

            if (isset($_POST["profesor"]) && $_POST["profesor"] == $usuario->id_usuario) {

                $nombre = $usuario->nombre;
                echo '<option value="' . $usuario->id_usuario . '" selected >' . $usuario->nombre . '</option>';
            } else {
                echo '<option value="' . $usuario->id_usuario . '">' . $usuario->nombre . '</option>';
            }
        }

        echo "</select>";
        echo '<button type="submit" name="ver">Ver horario</button>';
        echo "</form>";

        if (isset($_POST["ver"]) || isset($_POST['editarHora']) || isset($_POST['editargrupo'])) {

            $url = DIR_SERV . "/horario/" . $_POST["profesor"];
            $respuesta = consumir_servicios_REST($url, "GET");

            $obj = json_decode($respuesta);
            if (!$obj) {
                echo "Error al consumir el servicio $url. " . $respuesta;
            }

            if (isset($obj->error)) {
                echo $obj->error;
            } else {

                echo "<h1>Horario del profesor $nombre</h1>";

                echo "<table border='1'>";

                $dias = ["", "LUNES", "MARTES", "MIRECOLES", "JUEVES", "VIERNES"];
                $horas = ["", "8:15 - 9:15", "9:15 - 10:15", "10:15 - 11:15", "11:15 - 11:45", "11:45 - 12:45", "12:45 - 13:45", "13:45 - 14:45"];

                for ($i = 0; $i < count($horas); $i++) {
                    echo "<tr>";
                    echo "<td>$horas[$i]</td>";
                    for ($j = 1; $j < count($dias); $j++) {
                        if ($i == 0) {
                            echo "<th>$dias[$j]</th>";
                        } elseif ($i == 4) {
                            echo "<td colspan='5'>RECREO</td>";
                            break;
                        } else {
                            echo "<td>" .  obtenerGrupo($i, $j, $obj->horario);

                            echo '<form action="index.php" method="post">
                            <input type="hidden" name="hora" value="' . $i . '">
                            <input type="hidden" name="dia" value="' . $j . '">
                            <input type="hidden" name="profesor" value="' . $_POST["profesor"] . '">
                            <button type="submit" name="editarHora">editar</button>
                            </form>';

                            echo "</td>";
                        }
                    }
                    echo "</tr>";
                }


                echo "</table>";

                if (isset($_POST['editarHora'])) {
                    echo "<h1>Editando la " . $_POST["hora"] . "ª hora (" . $horas[$_POST["hora"]] . ") del " . $dias[$_POST["dia"]] . "</h1>";

                    echo "<table border='1'>";

                    echo "<tr><th>Grupo</th><th>Accion</th></tr>";

                    $url = DIR_SERV . "/tieneGrupo/" . $_POST["dia"] . "/" . $_POST["hora"] . "/" . $_POST["profesor"];

                    $respuesta = consumir_servicios_REST($url, "GET");

                    $obj = json_decode($respuesta);
                    if (!$obj) {
                        echo "Error al consumir el servicio $url. " . $respuesta;
                    }

                    if (isset($obj->error)) {

                        echo $obj->error;
                    } elseif (isset($obj->tiene_grupo) && $obj->tiene_grupo) {

                        $url = DIR_SERV . "/grupos/" . $_POST["dia"] . "/" . $_POST["hora"] . "/" . $_POST["profesor"];

                        $respuesta = consumir_servicios_REST($url, "GET");

                        $obj = json_decode($respuesta);
                        if (!$obj) {
                            echo "Error al consumir el servicio $url. " . $respuesta;
                        }

                        if (isset($obj->error)) {

                            echo $obj->error;
                        } else {

                            foreach ($obj->grupos as $grupo) {
                                echo "<tr><td>$grupo->nombre</td>";
                                echo '<td>
                                
                                <button type="submit" name="editargrupo">editar</button>
                            
                                </td>';
                                echo "</tr>";
                            }
                        }
                    }

                    echo "</table>";
                }
            }
        }
    }
    ?>



</body>

</html>