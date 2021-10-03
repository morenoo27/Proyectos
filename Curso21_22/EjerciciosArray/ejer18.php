<!DOCTYPE html>
<html>

<head>
    <title>Ejercicio18</title>
    <meta charset="UTF-8" />
</head>

<body>
    <h1>Deportes</h1>
    <?php
    $deportes = array("futbol", "baloncesto", "natacion", "tenis");

    for($i = 0; $i < count($deportes); $i++){

        echo "<p>".$deportes[$i]."</p>"; 
    }
    
    echo "<p>Primer elemento: ".current($deportes)."</p>";

    next($deportes);
    echo "<p>Despues de avanzar: ".current($deportes)."</p>";

    end($deportes);
    echo "<p>Ultimo elemento: ".current($deportes)."</p>";

    prev($deportes);
    echo "<p>Penultimo elemento: ".current($deportes)."</p>";
    ?>
</body>

</html>