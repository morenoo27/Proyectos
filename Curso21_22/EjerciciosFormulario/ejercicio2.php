<?php
const PRODUCTOS = ["Coca Cola" => 1, "Pepsi Cola" => 0.80, "Fanta Naranja" => 0.90, "Trina manazna" => 1.20];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejrcicio2</title>
</head>

<body>
    <form action="ejercicio2.php" method="POST">
        <select name="bebida" id="bebida">
            <?php
            foreach (PRODUCTOS as $bebida => $precio) {
                echo "<option value='$bebida'>$bebida (" . $precio . "€ uds.)</option>";
            }
            ?>
        </select>

        <br><br>

        <label for="numero">Cantidad: </label>
        <input type="number" name="cantidad" id="numero" min="1" value="1">

        <br><br>

        <input type="submit" value="Enviar datos" name="enviar">
    </form>

    <br>

    <?php
    if (isset($_POST["enviar"])) {
        echo "Has pedido " . $_POST["cantidad"] . " unidades de " . $_POST["bebida"] . "<br>";
        $precioTotal = PRODUCTOS[$_POST["bebida"]] * $_POST["cantidad"];
        echo "precio total: $precioTotal";
    }
    ?>
</body>

</html>