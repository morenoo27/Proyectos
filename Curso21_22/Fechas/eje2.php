<?php

const MESES = ["a", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

if (isset($_POST["calcular"])) {
    $errorFecha1 = !checkdate($_POST["mes1"], $_POST["dia1"], $_POST["anio1"]);
    $errorFecha2 = !checkdate($_POST["mes2"], $_POST["dia2"], $_POST["anio2"]);

    $errores = $errorFecha1 || $errorFecha2;
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
        h2 {
            text-align: center;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <form action="eje2.php" method="post">
        <label>Introduce una fecha</label><br>

        <label for="dia1">Dia: </label>
        <select name="dia1" id="dia1">
            <?php
            for ($i = 1; $i <= 31; $i++) {
                echo "<option value='" . sprintf('%02d', $i) . "'";          //<option value="i" 
                if (isset($_POST["dia1"]) && $_POST["dia1"] == $i) {
                    echo "selected";                                        //(selected)
                };
                echo ">" . sprintf('%02d', $i) . "</option>";                //>i</option>
            }
            ?>
        </select>

        <label for="mes1"> Mes: </label>
        <select name="mes1" id="mes1">
            <?php
            for ($i = 1; $i <= 12; $i++) {
                echo "<option value='" . $i . "'";                          //<option value="i" 
                if (isset($_POST["mes1"]) && $_POST["mes1"] == $i) {
                    echo "selected";                                        //(selected)
                };
                echo ">" . MESES[$i] . "</option>";                         //>i</option>
            }
            ?>
        </select>

        <label for="anio1"> Año: </label>
        <select name="anio1" id="anio1">
            <?php
            for ($i = 50; $i >= 0; $i--) {
                $anio = date("Y") - $i;
                echo "<option value='" . $anio . "'";                       //<option value="i" 
                if (isset($_POST["anio1"]) && $_POST["anio1"] == $anio) {
                    echo "selected";                                        //(selected)
                };
                echo ">" . $anio . "</option>";                              //>i</option>
            }
            ?>
        </select>

        <?php
        if (isset($_POST["calcular"]) && $errorFecha1) {
            echo "<label calss='error'>*Fecha introducida no valida*</label>";
        }
        ?>

        <br>
        <br>
        <label>Introduce una fecha</label><br>

        <label for="dia2">Dia: </label>
        <select name="dia2" id="dia2">
            <?php
            for ($i = 1; $i <= 31; $i++) {
                echo "<option value='" . sprintf('%02d', $i) . "'";          //<option value="i" 
                if (isset($_POST["dia2"]) && $_POST["dia2"] == $i) {
                    echo "selected";                                         //(selected)
                };
                echo ">" . sprintf('%02d', $i) . "</option>";                //>i</option>
            }
            ?>
        </select>

        <label for="mes2"> Mes: </label>
        <select name="mes2" id="mes2">
            <?php
            for ($i = 1; $i <= 12; $i++) {
                echo "<option value='" . $i . "'";         //<option value="i" 
                if (isset($_POST["mes2"]) && $_POST["mes2"] == $i) {
                    echo "selected";                                        //(selected)
                };
                echo ">" . MESES[$i] . "</option>";                         //>i</option>
            }
            ?>
        </select>

        <label for="anio2"> Año: </label>
        <select name="anio2" id="anio2">
            <?php
            for ($i = 50; $i >= 0; $i--) {
                $anio = date("Y") - $i;
                echo "<option value='" . $anio . "'";                       //<option value="i" 
                if (isset($_POST["anio2"]) && $_POST["anio2"] == $anio) {
                    echo "selected";                                        //(selected)
                };
                echo ">" . $anio . "</option>";                              //>i</option>
            }
            ?>
        </select>

        <?php
        if (isset($_POST["calcular"]) && $errorFecha2) {
            echo "<label calss='error'>*Fecha introducida no valida*</label>";
        }
        ?>

        <br>
        <br>

        <input type="submit" name="calcular" value="Calcular diferencia entre fechas">
    </form>

    <?php
    if (isset($_POST["calcular"]) && !$errores) {

        //$_POST["mes1"], $_POST["dia1"], $_POST["anio1"]
        //$_POST["mes2"], $_POST["dia2"], $_POST["anio2"]

        $segFecha1 = mktime(0, 0, 0, $_POST["mes1"], $_POST["dia1"], $_POST["anio1"]);
        $segFecha2 = mktime(0, 0, 0, $_POST["mes2"], $_POST["dia2"], $_POST["anio2"]);
        $resultado = abs($segFecha1 - $segFecha2) /  (3600 * 24);

        echo "<br><br><p>La diferencia entre estas fechas (en dias) es de: " . $resultado . " dias</p>";
    }
    ?>
</body>

</html>