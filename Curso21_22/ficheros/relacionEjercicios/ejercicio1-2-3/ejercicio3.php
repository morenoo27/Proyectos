<?php
if (isset($_POST["generar"])) {

    $errorNum = $_POST["numero"] == "" || !is_numeric($_POST["numero"]) || $_POST["numero"] < 1 || $_POST["numero"] > 10;
    $errorFila = $_POST["fila"] == "" || !is_numeric($_POST["fila"]) || $_POST["fila"] < 1 || $_POST["fila"] > 10;

    $error = $errorNum | $errorFila;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>

    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <form action="ejercicio3.php" method="post">
        <p>
            <label for="inputTexto">Introduzca un numero del 1 al 10: </label>
            <input type="text" name="numero" id="inputTexto" value="<?php if (isset($_POST["numero"])) echo $_POST["numero"] ?>">
            <?php
            if (isset($_POST["generar"]) && $errorNum) {

                switch ($_POST["numero"]) {
                    case "":
                        echo "<label class='error'>*Campo vacio*</label>";
                        break;
                    case !is_numeric($_POST["numero"]):
                        echo "<label class='error'>*No es un numero*</label>";
                        break;
                    case $_POST["numero"] < 1 || $_POST["numero"] > 10:
                        echo "<label class='error'>*Valor fuera de lo establecido*</label>";
                        break;
                    default:
                        # code...
                        break;
                }
            }
            ?>
        </p>
        <p>
            <label for="inputTexto1">Introduzca un numero del 1 al 10: </label>
            <input type="text" name="fila" id="inputTexto1" value="<?php if (isset($_POST["fila"])) echo $_POST["fila"] ?>">
            <?php
            if (isset($_POST["generar"]) && $errorFila) {

                switch ($_POST["fila"]) {
                    case "":
                        echo "<label class='error'>*Campo vacio*</label>";
                        break;
                    case !is_numeric($_POST["fila"]):
                        echo "<label class='error'>*No es un numero*</label>";
                        break;
                    case $_POST["fila"] < 1 || $_POST["fila"] > 10:
                        echo "<label class='error'>*Valor fuera de lo establecido*</label>";
                        break;
                    default:
                        # code...
                        break;
                }
            }
            ?>
        </p>
        <p>
            <button type="submit" name="generar">Generar</button>
        </p>
    </form>

    <?php
    if (isset($_POST["generar"]) && !$error) {

        $numero = $_POST["numero"];
        $fila = $_POST["fila"];

        @$fd = fopen("Tablas/tabla_$numero.txt", "r");

        if (!$fd) die("<p>Aun se ha generado el archivo <em>tabla_$numero.txt</em></p>");

        $contadorLinea = 1;
        while (!feof($fd)) {
            $linea = fgets($fd);

            if ($fila == $contadorLinea) {    
                echo "<p>$linea</p>";
            }
            $contadorLinea++;
        }

        fclose($fd);
    }
    ?>

</body>

</html>