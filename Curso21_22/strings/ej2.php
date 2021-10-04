<?php
if (isset($_POST["comparar"])) {

    $errorPalabra1 = $_POST["palabra1"] == "" || strlen($_POST["palabra1"]) < 3;
}

function isCap_Pal($text)
{
    $i = 0;
    $j = strlen($text) - 1;
    $text = strtolower($text);
    while ($i < $j) {
        if ($text[$i] != $text[$j]) {
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
    <title>Ejercicio </title>
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
        <form action="ej2.php" method="post">
            <h2>Ripios-Formulario</h2>
            <p>
                Introduce dos palabras para comparar si riman o no. <br>
                Si sus tres ultimas letras son iguales, rimaran. <br>
                Si sus dos ultimas letras son iguales, rimaran un poco <br>
                Si no, no rimaran
            </p>
            <p>
                <label for="palabra1">Introduce una palabra :</label>
                <input type="text" name="palabra1" id="palabra1" value="<?php if (isset($_POST["palabra1"]) && !$errorPalabra1) $_POST["palabra1"] ?>">
                <?php
                if (isset($_POST["comparar"]) && $errorPalabra1) {

                    if ($_POST["palabra1"] == "") {

                        echo "<label style='color:red;'>*Campo vacio*</label>";
                    } else {
                        echo "<label style='color:red;'>*La palabra debe ser mayor a 3 carcteres*</label>";
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
        if (isCap_Pal($_POST["palabra1"])) {

            if (is_numeric($_POST["palabra1"])) {
                echo "<p>El numero" . $_POST["palabra1"] . " es un numero capicuo</p>";
            } else {
                echo "<p>La palabra" . $_POST["palabra1"] . " es un palindromo</p>";
            }
        } else {
            if (is_numeric($_POST["palabra1"])) {
                echo "<p>El numero" . $_POST["palabra1"] . " no es un numero capicuo</p>";
            } else {
                echo "<p>La palabra" . $_POST["palabra1"] . " no es un palindromo</p>";
            }
        }
        echo "</div>";
    }
    ?>
</body>

</html>