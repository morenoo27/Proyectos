<?php
if (isset($_POST["enviar"])) {
    $errores =  $_POST["num1"] == "" || !is_numeric($_POST["num2"]) || $_POST["num2"] == "" || !is_numeric($_POST["num2"]);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejrcicio4</title>
</head>

<body>
    <form action="ejercicio4.php" method="post">
        <label for="numero1">Numero 1:</label>
        <input type="text" name="num1" id="numero1" <?php if (isset($_POST["enviar"])) echo "value='" . $_POST["num1"] . "'" ?>>
        <?php 
        if (isset($_POST["enviar"]) && $_POST["num1"] == "") {
            echo "<label style='color:red;'>*Campo obligatorio*</label>";
        }
        if (isset($_POST["enviar"]) && !is_numeric($_POST["num1"])) {
            echo "<label style='color:red;'>*Escribe un numero*</label>";
        } ?>
        <br><br>

        <label for="numero2">Numero 2:</label>
        <input type="text" name="num2" id="numero2" <?php if (isset($_POST["enviar"])) echo "value='" . $_POST["num2"] . "'" ?>>
        <?php
        if (isset($_POST["enviar"]) && $_POST["num2"] == "") {
            echo "<label style='color:red;'>*Campo obligatorio*</label>";
        }
        if (isset($_POST["enviar"]) && !is_numeric($_POST["num2"])) {
            echo "<label style='color:red;'>*Escribe un numero*</label>";
        } ?>
        <br><br>

        <input type="submit" value="Enviar datos" name="enviar">
    </form>

    <br>

    <?php if (isset($_POST["enviar"]) && !$errores) {

        $suma = $_POST["num1"] + $_POST["num2"];
        $resta = $_POST["num1"] - $_POST["num2"];
        $multiplicacion = $_POST["num1"] * $_POST["num2"];
        $division = $_POST["num1"] / $_POST["num2"];
        echo "SUMA:<br>";
        echo "$suma<br>";
        echo "RESTA:<br>";
        echo "$resta<br>";
        echo "MULTIPLICACION:<br>";
        echo "$multiplicacion<br>";
        echo "DIVISION:<br>";
        echo "$division<br>";
    } ?>
    <br>
</body>


</html>