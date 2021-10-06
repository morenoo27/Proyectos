<?php

function esFecha($strfecha)
{
    if (strlen($strfecha) == 10) {

        $dia = substr($strfecha, 0, 2);
        $sep = substr($strfecha, 2, 1);
        $mes = substr($strfecha, 3, 2);
        $anio = substr($strfecha, 6, 4);
        $sep .= substr($strfecha, 5, 1);

        if ($sep == "//") {
            return checkdate($mes, $dia, $anio);
        }
    }
    return false;
}

if (isset($_POST["comparar"])) {
    $errorFecha1 = $_POST["fecha1"] == "" || esFecha($_POST["fecha1"]);
    $errorFecha2 = $_POST["fecha2"] == "" || esFecha($_POST["fecha2"]);

    $errores = $errorFecha1 || $errorFecha2;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h2 {
            text-align: center;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <form action="eje1.php" method="post">
        <label for="fecha1">Introduce una fecha (dd/mm/yyyy)</label>
        <input type="text" name="fecha1" id="fecha1" value=<?php if (isset($_POST["fecha1"]) && $errorFecha1) echo $_POST["fecha1"] ?>>
        <?php
        if (isset($_POST["comparar"]) && $errorFecha1) {
            if ($_POST["fecha1"] == "") {
                echo "<label class='error'>*Campo vacio*</label>";
            } else {
            }
        }
        ?>
        <br>
        <label for="fecha2">Introduce una fecha (dd/mm/yyyy)</label>
        <input type="text" name="fecha2" id="fecha2" value=<?php if (isset($_POST["fecha2"]) && $errorFecha2) echo $_POST["fecha2"] ?>>
        <?php
        if (isset($_POST["comparar"]) && $errorFecha2) {
            if ($_POST["fecha2"] == "") {
                echo "<label class='error'>*Campo vacio*</label>";
            } else {
                return false;
            }
        }
        ?>
        <br>

        <input type="submit" name="comparar" value="Comprobar Fechas">
    </form>

    <?php
    if (isset($_POST["comparar"]) && !$errores) {
        echo "<p>son validas</p>";
    }
    ?>
</body>

</html>