<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 6</title>
</head>

<body>
    <?php
    $ciudades = array("Madrid", "Barcelona", "New York", "Los Angeles", "Chicago");

    foreach ($ciudades as $posicion=>$nombre) { 
        
        echo "<p>La ciudad con el indice $posicion tiene el nombre $nombre</p>";
    }
    ?>
</body>

</html>