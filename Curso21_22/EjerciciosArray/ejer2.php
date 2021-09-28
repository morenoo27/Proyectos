<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 2</title>
</head>

<body>
    <h1>Ejercicio 2</h1>
    <?php
    $v = array('1' => 90, '30' => 7, 'e' => 99, 'hola' => 43);

    foreach ($v as $posicion => $valor) {

        echo "<p>" . $valor . "</p>";
    }
    ?>
</body>

</html>