<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 7</title>
</head>

<body>
    <?php
    $ciudades = array("MA" => "Madrid", "BC" => "Barcelona", "NY" => "New York", "LA" => "Los Angeles", "CH" => "Chicago");

    foreach ($ciudades as $inicial => $nombre) {

        echo "<p>La ciudad que tiene como valor $nombre es $inicial</p>";
    }
    ?>
</body>

</html>