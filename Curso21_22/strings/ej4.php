<?php

const LETRASPERMITIDAS = ["M", "D", "C", "L", "X", "V", "I"];

if (isset($_POST["comparar"])) {

    $errorPalabra1 = $_POST["palabra1"] == "" || !isCorrect(strtoupper($_POST["palabra1"]));
}

function isCorrect(String $textoRomano)
{
    return letrasBien($textoRomano) && ordenBien($textoRomano) && menosDe4($textoRomano);
}

function letrasBien(String $texto)
{
    for ($i = 0; $i < strlen($texto) - 1; $i++) {
        if (!in_array($texto[$i], LETRASPERMITIDAS)) {
            return false;
        }
    }
    return true;
}

function ordenBien(String $texto)
{
    for ($i = 0; $i < strlen($texto) - 2; $i++) {

        if (!esMayorOIgual($texto, $i)) {
            return false;
        }
    }
    return true;
}

function esMayorOIgual($texto, $indice)
{
    $letra = "";
    $i = 0;
    for ($i; $i < count(LETRASPERMITIDAS); $i++) {
        if (LETRASPERMITIDAS[$i] == $texto[$indice]) {
            $letra = LETRASPERMITIDAS[$i];
            break;
        }
    }

    if ($texto[$indice + 1] == LETRASPERMITIDAS[$i]) {
        # code...
    }
}

function menosDe4(String $texto)
{
    # code...
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
        <form action="ej4.php" method="post">
            <h2>Ripios-Formulario</h2>
            <p>
                <label for="palabra1">Introduce una palabra :</label>
                <input type="text" name="palabra1" id="palabra1" value="<?php if (isset($_POST["palabra1"]) && !$errorPalabra1) $_POST["palabra1"] ?>">
                <?php
                if (isset($_POST["comparar"]) && $errorPalabra1) {

                    if ($_POST["palabra1"] == "") {

                        echo "<label style='color:red;'>*Campo vacio*</label>";
                    } else {
                        echo "<label style='color:red;'>*No has escrito bien el numero romano*</label>";
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
    if (isset($_POST["comparar"]) && !$errorPalabra1) {
        echo "<div class='respuesta'>";
        echo "<h2>Ripios-Respuesta</h2>";
        echo "</div>";
    }
    ?>
</body>

</html>