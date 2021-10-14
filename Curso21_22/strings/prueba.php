<?php
if (isset($_POST["comparar"])) {

    $error = $_POST["numero"] == "";
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
                <label for="numero">Dime un numero en arabe y lo paso a romano :</label>
                <input type="text" name="numero" id="numero" value="<?php if (isset($_POST["numero"]) && $error) echo $_POST["numero"] ?>">
                <?php
                if (isset($_POST["comparar"]) && $error) {
                    if ($_POST["numero"] == "") {

                        echo "<label style='color:red;'>*Campo vacio*</label>";
                    } else {
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

        echo "</div>";
    }
    ?>
</body>

</html>