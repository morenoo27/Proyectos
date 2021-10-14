<?php

const NUMEROPARES = 10;



function generarPares()
{
    //variables necesarias(instanciacion del array y contador)
    $pares=array();
    $contPush = 0;

    //mientras la longitud sea menor o igual al numero maximo de pares(const)
    while (count($pares) <= NUMEROPARES) {

        //si el resto entre 2 es igual a cero sera par
        if ($contPush % 2 == 0) {
            $pares[] = $contPush;//lo metemos en el array
        }

        $contPush++;//sumamos uno al contador
    }

    return $pares;
}

function escribirPares($array)
{
    for ($i=0; $i < count($array) -1; $i++) { 
        echo "<p>". $array[$i] . "<p/>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 1</title>
</head>

<body>
    <h1>Ejercicio 1</h1>
    <?php escribirPares(generarPares()) ?>
</body>

</html>