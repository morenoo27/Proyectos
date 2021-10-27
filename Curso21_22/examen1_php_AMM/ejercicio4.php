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
            <p>
                <label for="archivo">Introduce un archivo: (No mayor de 1MB)</label> <br>
                <input type="file" name="archivo" id="archivo">
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
            </p>
        </form>

        <?php
        if (isset($_POST["subir"]) && !$error) {
            echo "No se ha podido subir el archivo";
        }
        ?>

    <?php
    } else {    ?>
        <h2>Horario de los profesores</h2>

        <label for="profesores">Horario del profesor:</label>
    <?php
    } ?>
</body>

</html>