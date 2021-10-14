<?php

if (isset($_POST["convertir"])) {

    $error = $_POST["numeros"] == "" || todosNumericos($_POST["numeros"]);
}
function todosNumericos($texto)
{
    $texto = str_replace(".", ",", $texto);
    $arrayNumeros = explode(" ", $texto);
    foreach ($arrayNumeros as $numero) {

        if (!is_numeric($numero)) {
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
    <title>Ejercicio 7</title>
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

        form,
        p {
            margin-left: 2em
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <div class="formulario">
        <form action="ej7.php" method="post">
            <h2>Unifica separador decimal-Formulario</h2>
            <p>
                <label for="numeros">Dime una numeros y le quitare los acentos:</label><br>
                <input type="text" name="numeros" id="numeros">
                <?php
                if (isset($_POST["convertir"]) && $error) {
                    if ($_POST["numeros"] == "") {

                        echo "<label class='error'>*Campo vacio*</label>";
                    } else {
                        echo "<label class='error'>*Lo que has escrito no son numeros*</label>";
                    }
                }
                ?>
            </p>

            <p>
                <input type="submit" value="Convertir" name="convertir">
            </p>
        </form>
    </div>

    <?php
    if (isset($_POST["convertir"]) && !$error) {
        echo "<div class='respuesta'>";
        echo "<h2>Ripios-Respuesta</h2>";

        $numeros = explode(" ", str_replace(".", ",", $_POST["numeros"]));
        $solucion = "";

        foreach($numeros as $numero){
            $solucion.= "$numero ";
        }

        echo "<p>Numeros sin corregir:<br>" . $_POST["numeros"] . "</p>";
        echo "<p>Numeros corregidos:<br>$solucion</p>";
        echo "</div>";
    }
    ?>
</body>

</html>