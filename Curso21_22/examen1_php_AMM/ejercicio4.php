<?php

if (isset($_POST["subir"])) {

    $error = $_FILES["archivo"]["name"] == "" || $_FILES["archivo"]["name"] != "horarios.txt" || $_FILES["archivo"]["type"] != "text/plain" || $_FILES["archivo"]["size"] > 1 * 1000000;

    if (!$error) {
        @$fd = move_uploaded_file($_FILES["archivo"]["tmp_name"], "Horario/horarios.txt");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
</head>

<body>
    <h1>Ejercicio 4</h1>
    <?php
    @$fd = fopen("Horario/horarios.txt", "r");

    if (!$fd) { ?>
        <h2>No se ha encontrado el archivo <i>Horario/horarios.txt</i></h2>
        <form action="ejercicio4.php" method="post" enctype="multipart/form-data">
            <p>
                <label for="archivo">Introduce un archivo: (No mayor de 1MB)</label> <br>
                <input type="file" name="archivo" id="archivo" accept=".txt">
                <?php
                if (isset($_POST["subir"]) && $error) {
                    if ($_FILES["archivo"]["type"] != "text/plain") {
                        echo "<span class='error'>*El archivo no es de tipo texto*</span>";
                    }

                    if ($_FILES["archivo"]["size"] > 1 * 1000000) {
                        echo "<span class='error'>*El archivo es superior a 1MB*</span>";
                    }

                    if ($_FILES["archivo"]["name"] != "horarios.txt") {
                        echo "<span class='error'>*No es horarios.txt*</span>";
                    }
                }
                ?>
            </p>

            <p>
                <button type="submit" name="subir">Subir fichero</button>
            </p>
        </form>

        <?php
        if (isset($_POST["subir"]) && !$error) {
            echo "No se ha podido subir el archivo";
        }
    } else {    ?>
        <h2>Horario de los profesores</h2>

        <form action="ejercicio4.php" method="post">
            <p>
                <label for="profesores">Horario del profesor:</label>
                <select name="profesor" id="profesores">
                    <?php
                    while (!feof($fd)) {
                        $linea = fgets($fd);
                        $valores = explode("\t", $liena);
                        if (isset($_POST["profesor"]) && $valores[0] == $_POST["profesor"]) {
                            echo "<option value='" . $valores[0] . "' selected>" . $valores[0] . "</option>";
                        } else {
                            echo "<option value='" . $valores[0] . "'>" . $valores[0] . "</option>";
                        }
                    }
                    ?>
                </select>
                <button type="submit" name="verHorario">Ver horario</button>
            </p>
        </form>
    <?php

        if (isset($_POST["verHorario"])) {
            $hora = ["", "8:15 - 9:15", "9:15 - 10:15", "10:15 - 11:15", "11:15 - 11:45", "11:45 - 12:15", "12:45 - 13:45", "13:45 - 14:45"];
            echo $_POST["profesor"];
            echo "<table border='1'>";
            echo "<tr>";
            echo "<th></th><th>Lunes</th><th>Martes</th><th>Miercoles</th><th>Jueves</th><th>Viernes</th>";
            echo "</tr>";
            for ($i = 1; $i <= 7; $i++) {
                echo "<th>" . $hora[$i] . "</th>";
            }
            echo "</table>";
        }

        fclose($fd);
    } ?>





</body>

</html>