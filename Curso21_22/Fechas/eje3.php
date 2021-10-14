<?php
if (isset($_POST["calcular"])) {
    
    $errores = $_POST["fecha1"] == "" || $_POST["fecha2"] == "";
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
        h2 {
            text-align: center;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <form action="eje3.php" method="post">
        <label for="fecha1">Introduzca una fecha: </label>
        <input type="date" name="fecha1" id="fecha1">
        <?php if (isset($_POST["calcular"]) && $_POST["fecha1"] == "") {
            echo "<label class='error'>*Introduce una fecha*</label>";
        } ?>

        <br>
        <label for="fecha2">Introduzca una fecha: </label>
        <input type="date" name="fecha2" id="fecha2">
        <?php
        /*date devuelve un string en formato AAAA-MM-DD*/
        if (isset($_POST["calcular"]) && $_POST["fecha2"] == "") {
            echo "<label class='error'>*Introduce una fecha*</label>";
        }?>

        <br><br>
        <input type="submit" value="Calcular diferencia" name="calcular">
    </form>

    <?php
    if (isset($_POST["calcular"]) && !$errores) {
        
        $fecha1 = explode("-", $_POST["fecha1"]); // 0->year 1->mes 2->dia
        $fecha2 = explode("-", $_POST["fecha2"]);

        $segFecha1 = mktime(0, 0, 0, $fecha1[1], $fecha1[2], $fecha1[0]);
        $segFecha2 = mktime(0, 0, 0, $fecha2[1], $fecha2[2], $fecha2[0]);
        $resultado = abs($segFecha1 - $segFecha2) /  (3600 * 24);

        echo "<br><br><p>La diferencia entre estas fechas (en dias) es de: " . $resultado . " dias</p>";
    }
    ?>
</body>

</html>