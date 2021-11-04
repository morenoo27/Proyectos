<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoría BD PHP</title>
</head>

<body>
    <?php
    @$conexion = mysqli_connect("localhost", "jose", "josefa", "bd_teoria");
    if (!$conexion) {

        die("Imposible conectar. Error número: " . mysqli_connect_errno() .
            " : " . mysqli_connect_error());
    }
    mysqli_set_charset($conexion, "utf8");

    $consulta = "select * from alumnos";
    $resultado = mysqli_query($conexion, $consulta);
    if ($resultado) {

        $n_tuplas = mysqli_num_rows($resultado);
        echo "<p>El número de alumnos en la bd es: " . $n_tuplas . "</p>";
        $datos = mysqli_fetch_row($resultado);
        echo "<p>" . $datos[2] . "</p>";
        $datos = mysqli_fetch_assoc($resultado);
        echo "<p>" . $datos["telefono"] . "</p>";
        $datos = mysqli_fetch_array($resultado);
        var_dump($datos);
        mysqli_data_seek($resultado, 0);
        //$datos = mysqli_fetch_object($resultado);
        echo "<p>Recorro todos los resultados</p>";
        while ($datos = mysqli_fetch_assoc($resultado)) {

            var_dump($datos);
            echo "<br/>";
        }

        mysqli_free_result($resultado);
        mysqli_close($conexion);
    } else {

        $error = "<p>Imposible realizar la consulta. Error número: "
            . mysqli_errno($conexion) . " : " . mysqli_error($conexion) . "</p>";
        mysqli_close($conexion);
        die($error);
    }
    ?>
</body>

</html>