<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 16</title>
</head>

<body>


    <?php
    $numeros = array("5" => "1", "12" => "2", "13" => "56", "x" => "42");

    $cantidad = 0;
    print_r($numeros);
    foreach ($numeros as $numero) {
        $cantidad++;
    }
    echo "<br/>Cantidad: $cantidad<br/>";
    unset($numeros["5"]); //para borrar
    print_r($numeros);

    unset($numeros);
    print_r($numeros);
    ?>

</body>

</html>