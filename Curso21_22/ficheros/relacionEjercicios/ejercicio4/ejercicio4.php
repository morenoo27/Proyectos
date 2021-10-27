<?php
if (isset($_POST["enviar"])) {
    $error = $_FILES["texto"]["name"] == "" || $_FILES["texto"]["type"] != "text/plain";
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
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <form action="ejercicio4.php" method="post">
        <p>
            <label for="inputTexto">Introduce un archivo de tipo texto (No mayor de 2'5 MB): </label>
            <input type="file" name="texto" id="inputTexto">
            <?php
            if (isset($_POST["enviar"]) && $error) {
                switch ($_FILES["texto"]) {
                    case $_FILES["texto"]["name"] == "":
                        echo "<label class='error'>*Campo vacio*</label>";
                        break;
                    case !str_contains($_FILES["texto"]["name"], "txt"):
                        echo "<label class='error'>*Campo vacio*</label>";
                        break;
                    default:
                        # code...
                        break;
                }
            }
            ?>
        </p>
        <p>
            <button type="submit" name="enviar">Enviar texto</button>
        </p>
    </form>
</body>

</html>