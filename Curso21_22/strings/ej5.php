<?php

const ROMANOS = [1000 => "M", 500 => "D", 100 => "C", 50 => "L", 10 => "X", 5 => "V", 1 => "I"];

if (isset($_POST["comparar"])) {

    $errorNumero = $_POST["numero"] == "" || !is_numeric($_POST["numero"]) || $_POST["numero"] <= 0 || $_POST["numero"] >= 5000;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5</title>
    <style>
        .formulario {
            border: 2px solid black;
            background-color: lightblue
        }

        .respuesta {
            border: 2px solid black;
            background-color: lightgreen
        }

        h2 {
            text-align: center
        }

        form {
            margin-left: 2em
        }
    </style>
</head>

<body>
    <div class="formulario">
        <form action="ej5.php" method="post">
            <h2>Ripios-Formulario</h2>
            <p>
                <label for="numero">Dime un numero en arabe y lo paso a romano :</label>
                <input type="text" name="numero" id="numero" value="<?php if (isset($_POST["numero"]) && $errorNumero) echo $_POST["numero"] ?>">
                <?php
                if (isset($_POST["comparar"]) && $errorNumero) {
                    if ($_POST["numero"] == "") {

                        echo "<label style='color:red;'>*Campo vacio*</label>";
                    } else {
                        if (!is_numeric($_POST["numero"])) {
                            echo "<label style='color:red;'>*No has escrito un numero*</label>";
                        } else {
                            if ($_POST["numero"] <= 0) {
                                echo "<label style='color:red;'>*El numero es menor a 0*</label>";
                            }
                            if ($_POST["numero"] >= 5000) {
                                echo "<label style='color:red;'>*El numero es mayor a 5000*</label>";
                            }
                        }
                    }
                }
                ?>
            </p>

            <p>
                <input type="submit" value="Comparar" name="comparar">
            </p>
        </form>
    </div>

    <?php
    if (isset($_POST["comparar"]) && !$errorNumero) {
        echo "<div class='respuesta'>";
        $romano = "";
        $numero = $_POST["numero"];
        do {
            switch ($numero) {
                case $numero >= 1000:
                    $numero -= 1000;
                    $romano .= ROMANOS[1000];
                    break;

                case $numero >= 500:
                    $numero -= 500;
                    $romano .= ROMANOS[500];
                    break;
                case $numero >= 100:
                    $numero -= 100;
                    $romano .= ROMANOS[100];
                    break;
                case $numero >= 50:
                    $numero -= 50;
                    $romano .= ROMANOS[50];
                    break;
                case $numero >= 10:
                    $numero -= 10;
                    $romano .= ROMANOS[10];
                    break;
                case $numero >= 5:
                    $numero -= 5;
                    $romano .= ROMANOS[5];
                    break;
                case $numero >= 1:
                    $numero -= 1;
                    $romano .= ROMANOS[1];
                    break;
            }
        } while ($numero > 0);
        
        echo "<h2>Ripios-Respuesta</h2>";
        echo "<p>El numero ".$_POST["numero"]." es $romano en numeros romanos</p>";
        echo "</div>";
    }
    ?>
</body>

</html>