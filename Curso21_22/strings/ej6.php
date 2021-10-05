<?php

const ACENTUADAS = ["Á", "É", "Í", "Ó", "Ú", "á", "é", "í", "ó", "ú"];
const NOACENTUADAS = ["A", "E", "I", "O", "U", "a", "e", "i", "o", "u"];

if (isset($_POST["comparar"])) {

    $error = $_POST["frase"] == "" | is_numeric($_POST["frase"]);
}

function reemplazarAcentuadas($frase)
{
    return str_replace(ACENTUADAS, NOACENTUADAS, $frase);
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
        <form action="ej.php" method="post">
            <h2>Ripios-Formulario</h2>
            <p>
                <label for="frase">Dime una frase y le quitare los acentos:</label><br>
                <textarea name="frase" id="frase" cols="30" rows="10"><?php if (isset($_POST["frase"]) && $error) echo $_POST["frase"] ?></textarea>
                <?php
                if (isset($_POST["comparar"]) && $error) {
                    if ($_POST["frase"] == "") {

                        echo "<label style='color:red;'>*Campo vacio*</label>";
                    } else {
                        echo "<label style='color:red;'>*Lo que has escrito no es una frase*</label>";
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
    if (isset($_POST["comparar"]) && !$error) {
        echo "<div class='respuesta'>";
        echo "<h2>Ripios-Respuesta</h2>";
        echo "<p>".$_POST["frase"]."</p>";
        echo "<p>".reemplazarAcentuadas($_POST["frase"])."</p>";
        echo "</div>";
    }
    ?>
</body>

</html>