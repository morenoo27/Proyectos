<?php

const LETRASPERMITIDAS = ["M" => 1000, "D" => 500, "C" => 100, "L" => 50, "X" => 10, "V" => 5, "I" => 1];

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
        if (!isset(LETRASPERMITIDAS[$texto[$i]])) {
            return false;
        }
    }
    return true;
}

function ordenBien(String $texto)
{
    for ($i = 0; $i < strlen($texto) - 1; $i++) {

        if (LETRASPERMITIDAS[$texto[$i]] < LETRASPERMITIDAS[$texto[$i + 1]]) {
            return false;
        }
    }
    return true;
}

function menosDe4(String $texto)
{
    /*Creamos un array  con la veces que se puede repetir*/
    $veces["M"] = 4;
    $veces["D"] = 1;
    $veces["C"] = 4;
    $veces["L"] = 1;
    $veces["X"] = 4;
    $veces["V"] = 1;
    $veces["I"] = 4;

    /*La condiciones comun a todos: cuando uno llege a -1, no esta bien repetido*/
    for ($i = 0; $i < strlen($texto); $i++) {

        $veces[$texto[$i]]--;
        if ($veces[$texto[$i]] == -1) {
            return false;
        }
    }
    return true;
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
                        if (!letrasBien(strtoupper($_POST["palabra1"]))) {
                            echo "<label style='color:red;'>*Las letras no estan bien escritas*</label>";
                        }
                        if (!ordenBien(strtoupper($_POST["palabra1"]))) {
                            echo "<label style='color:red;'>*No esta ordenado*</label>";
                        }
                        if (!menosDe4(strtoupper($_POST["palabra1"]))) {
                            echo "<label style='color:red;'>*Se repiten mas de lo permitido*</label>";
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
    if (isset($_POST["comparar"]) && !$errorPalabra1) {
        echo "<div class='respuesta'>";
        echo "<h2>Ripios-Respuesta</h2>";
        $valor["M"] = 1000;
        $valor["D"] = 500;
        $valor["C"] = 100;
        $valor["L"] = 50;
        $valor["X"] = 10;
        $valor["V"] = 5;
        $valor["I"] = 1;

        $resultado = 0;

        foreach ($_POST["palabra1"] as $letra) {
            $resultado += LETRASPERMITIDAS[strtoupper($letra)];
        }
        echo "<p>El numero" . $_POST["palabra1"] . " es " . $resultado . " en arabe</p>";
        echo "</div>";
    }
    ?>
</body>

</html>