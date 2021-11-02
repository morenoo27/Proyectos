<?php
function mirarGrupos($fd, $nombreProf, $dia, $hora)
{
    $respuesta = "";

    //nos vamos al inicio
    fseek($fd, 0);

    //captamos la fila
    $fila = [];
    while ($linea = fgets($fd)) {
        $profesor = explode("\t", $linea);
        if ($nombreProf == $profesor[0]) {
            $fila = $profesor;
            break;
        }
    }

    for ($i = 1; $i < count($fila); $i += 3) {
        if ($profesor[$i] == $dia && $profesor[$i + 1] == $hora) {
            if ($respuesta == "") {
                $respuesta = $profesor[$i + 2];
            } else {
                $respuesta .= "/" . $profesor[$i + 2];
            }

            break;
        }
    }

    return $respuesta;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
    <style>
        .centrar {
            text-align: center;
        }

        th {
            background-color: #ccc;
        }

        table {
            width: 80%;
        }
    </style>
</head>

<body>
    <h1>Ejercicio 4</h1>

    <form action="ejercicio4_2.php" method="post">
        <label for="prof">Horario del profesor:</label>
        <?php
        @$fd = fopen("horarios.txt", "r");
        if (!$fd) {
            die("No se puede abrir el fichero");
        }
        ?>
        <select name="profesores" id="prof">
            <?php
            while ($linea = fgets($fd)) {
                $profesor = explode("\t", $linea);
                $nombreProfesor = $profesor[0];
                if (isset($_POST["profesores"]) && $_POST["profesores"] == $nombreProfesor) {
                    echo "<option value='$nombreProfesor' selected>$nombreProfesor</option>";
                } else {
                    echo "<option value='$nombreProfesor'>$nombreProfesor</option>";
                }
            }

            ?>
        </select>
        <button type="submit" name="enviar">Ver horario</button>

    </form>

    <?php
    if (isset($_POST["enviar"])) {
        echo "<h3 class='centrar'>Horario del profesor" . $_POST['profesores'] . "</h3>";

        $hora = ["", "8:15 - 9:15", "9:15 - 10:15", "10:15 - 11:15", "11:15 - 11:45", "11:45 - 12:15", "12:45 - 13:45", "13:45 - 14:45"];

        //modelado inical de la tabla
        echo "<table class='centrar' border=1>";
        echo "<tr>";
        echo "<th></th>";
        echo "<th>LUNES</th>";
        echo "<th>MARTES</th>";
        echo "<th>MIERCOLES</th>";
        echo "<th>JUEVES</th>";
        echo "<th>VIERNES</th>";
        echo "<tr>";

        for ($i = 1; $i < count($hora); $i++) {
            echo "<tr>";
            echo "<td>" . $hora[$i] . "</td>";
            if ($i == 3) {
                echo "<td colspan=5>RECREO</td>";
            } else {
                for ($j = 1; $j <= 5; $j++) {
                    echo "<td>" . mirarGrupos($fd, $_POST['profesores'], $j, $i) . "</td>";
                }
            }

            echo "<tr>";
        }

        echo "</table>";
        fclose($fd);
    }

    ?>

</body>

</html>