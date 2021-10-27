<?php

if (isset($_POST["subir"])) {
    $error = $_FILES["archivo"]["name"] == "" || $_FILES["archivo"]["type"] != "text/plain" || $_FILES["archivo"]["size"] > 1 * 1000000;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <form action="ejercicio2.php" method="post" enctype="multipart/form-data">
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
        

        $_FILES["archivo"]["name"]="archivo";
        echo $_FILES["archivo"]["tmp_name"]."<br>";
        //mirar
        $fd = move_uploaded_file($_FILES["archivo"]["tmp_name"], "Ficheros");
        if (!$fd) {
            die("No se puede subir el archivo");
        }

        echo "Archivo subido a la carpeta Ficheros";
    }
    ?>
</body>

</html>