<?php
if (isset($_POST["generar"])) {

    $error = $_POST["numero"] == "" || !is_numeric($_POST["numero"]) || $_POST["numero"] < 1 || $_POST["numero"] > 10;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>

    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <form action="ejercicio1.php" method="post">
        <p>
            <label for="inputTexto">Introduzca un numero del 1 al 10: </label>
            <input type="text" name="numero" id="inputTexto" value="<?php if (isset($_POST["numero"])) echo $_POST["numero"] ?>">
            <?php
            if (isset($_POST["generar"]) && $error) {

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
            <button type="submit" name="generar">Generar</button>
        </p>
    </form>

    <?php
    if (isset($_POST["generar"]) && !$error) {
        $numero = $_POST["numero"];
        @$fd = fopen("Tablas/tabla_$numero.txt", "w");

        if (!$fd) die("<p>No se ha podido crear/abrir el fichero tabla_$numero.txt</p>");

        for ($i = 1; $i <= 10; $i++) {
            $linea = "$i X $numero = " . ($i * $numero);
            fputs($fd, $linea.PHP_EOL);
        }

        fclose($fd);

        echo "<h2>Archivo generado con exito: <a href='Tablas/tabla_$numero.txt'>tabla_$numero.txt</a></h2>";
    }
    ?>
    
</body>

</html>