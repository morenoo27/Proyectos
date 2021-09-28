<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 3</title>
</head>

<body>
    <h1>Ejercicio 3</h1>
    <?php
    $v = array('enero' => 9, 'febrero' => 12, 'marzo' => 0, 'abril' => 17);

    foreach ($v as $posicion => $valor) {

        echo "<p>" . $valor . "</p>";
    }
    ?>
</body>

</html>