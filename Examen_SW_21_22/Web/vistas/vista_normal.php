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
    <h2>Su horario</h2>


    <?php
    $url = DIR_SERV . "/horario/" . $datos_usuario_log->id_usuario;
    $respuesta = consumir_servicios_REST($url, "GET");

    $obj = json_decode($respuesta);
    if (!$obj) {
        echo "Error al consumir el servicio $url. " . $respuesta;
    }

    if (isset($obj->error)) {
        echo $obj->error;
    } else {

        echo "<h1>Horario del profesor" . $datos_usuario_log->nombre . "</h1>";

        echo "<table border='1'>";

        $dias = ["", "LUNES", "MARTES", "MIRECOLES", "JUEVES", "VIERNES"];
        $horas = ["", "8:15 - 9:15", "9:15 - 10:15", "10:15 - 11:15", "11:15 - 11:45", "11:45 - 12:45", "12:45 - 13:45", "13:45 - 14:45"];

        for ($i = 0; $i < count($horas); $i++) {
            echo "<tr>";
            echo "<td>$horas[$i]</td>";
            for ($j = 1; $j < count($dias); $j++) {
                if ($i == 0) {
                    echo "<td>$dias[$j]</td>";
                } elseif ($i == 4) {
                    echo "<td colspan='5'>RECREO</td>";
                    break;
                } else {
                    echo "<td>" .  obtenerGrupo($i, $j, $obj->horario) . "</td>";
                }
            }
            echo "</tr>";
        }


        echo "</table>";
    }
    ?>

</body>

</html>