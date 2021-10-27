<?php
if (isset($_POST["contar"])) {
    $errores = $_POST["texto"] == "";
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
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <form action="ejercicio3.php" method="post">
        <p>
            <label for="texto">Introduce un texto:</label> <br>
            <input type="text" name="texto" id="texto" value="<?php if (isset($_POST["contar"])) echo $_POST["texto"]; ?>">
            <?php
            if (isset($_POST["contar"]) && $errores) {
                echo "<span class='error'>*Campo obligatorio*</span>";
            }
            ?>
        </p>
        <p>
            <label for="separador">Seleccione un separador:</label> <br>
            <select name="sep" id="separador">
                <option value="," <?php if (isset($_POST["contar"]) && $_POST["sep"] == ",") echo "selected"; ?>>, (coma)</option>
                <option value=";" <?php if (isset($_POST["contar"]) && $_POST["sep"] == ";") echo "selected"; ?>>; (punto y coma)</option>
                <option value=" " <?php if (isset($_POST["contar"]) && $_POST["sep"] == " ") echo "selected"; ?>> (espacio)</option>
                <option value=":" <?php if (isset($_POST["contar"]) && $_POST["sep"] == ":") echo "selected"; ?>>: (dos puntos)</option>
            </select>
        </p>
        <p>
            <button type="submit" name="contar">Contar palabras</button>
        </p>
    </form>

    <?php
    if (isset($_POST["contar"]) && !$errores) {

        $contadorPalabras = 0;
        for ($i = 0; $i < strlen($_POST["texto"]) - 1; $i++) {

            if ($i == 0 && $_POST["texto"][$i] != $_POST["sep"]) {
                $contadorPalabras++;
            }

            if ($_POST["texto"][$i] == $_POST["sep"]) {
                if ($_POST["texto"][$i + 1] != $_POST["sep"]) {

                    $contadorPalabras++;
                }
            }
        }

        echo "Hay un total de $contadorPalabras palabras solo contando como delimitador el caracter: " . $_POST["sep"];
    }
    ?>
</body>

</html>