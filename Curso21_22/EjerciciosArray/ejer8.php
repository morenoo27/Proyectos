<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 8</title>
</head>

<body>
    <?php
    $ciudades = array("Pedro", "Ismael", "Sonia", "Susana", "Alfonso", "Teresa");

    echo "<ol>";
    foreach ($ciudades as $posicion=>$nombre) { 
        
        echo "<li>$nombre</li>";
    }
    echo "</ol>";
    ?>
</body>

</html>