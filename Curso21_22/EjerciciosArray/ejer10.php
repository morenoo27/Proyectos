<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 10</title>
</head>

<body>
    <?php
    $numeros = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);

    $length_numeros = count($numeros);
    $sumaMedia = 0;
    echo "<p>";
    //posiciones pares y los numeros impares tienen la misma posicion
    for ($i = 0; $i < $length_numeros; $i += 2) {
        //sumo los numeros y los escribo en pantalla en un solo p
        $sumaMedia += $numeros[$i];
        echo "$numeros[$i] ";
    }
    echo "</p>";
    ?>
    <p>Media:
        <?php echo $sumaMedia / ($length_numeros / 2);
        //hago la media de los totales de los impares que sera entre la longitud entre 2 
        ?>
    </p>
</body>

</html>