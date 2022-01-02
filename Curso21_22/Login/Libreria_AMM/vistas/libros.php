<?php

//CONSULTA
$consulta = "SELECT * FROM libros";
$resultado = mysqli_query($conexion, $consulta);

//CONTROL FALLO EN QUERY
if (!$resultado) {
    $numerr = mysqli_errno($conexion);
    $err = mysqli_error($conexion);
    echo "Error en la consulta a la base de datos. Error Nº:$numerr: $err";
} else {

    $contadorfotos = 0;

    while ($datos = mysqli_fetch_assoc($resultado)) {

        echo "<div class='libro'>";
        echo "<img src='Images/" . $datos["portada"] . "' alt='portada'> <br>";
        echo "<span>".$datos["titulo"] . " - ";
        echo $datos["precio"] . "€</span>";
        echo "</div>";

        $contadorfotos++;
        if ($contadorfotos % 3 == 0) {
            echo "<br>";
        }
    }
}