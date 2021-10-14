<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 9</title>
</head>

<body>
    <?php
    $lenguaje_cliente = array("JS" => "JavaScript", "HTML" => "HyperText Markup Language");
    $lenguajes_servidor = array("PHP" => "Hypertext Preprocessor", "MYSQL" => "My Structured Query Language");
    $lenguajes;

    //meto uno en el array
    $lenguajes = $lenguaje_cliente;

    //añado el otro array
    foreach ($lenguajes_servidor as $inicial => $nombre) {
        $lenguajes[$inicial] = $nombre;
    }
    ?>
    <table border="1">
        <tr>
            <th>Lenguajes</th>
        </tr>
        <?php
        foreach ($lenguajes as $inicial => $nombre) {
            echo "<tr><td>$nombre</td></tr>";
        }
        ?>
    </table>
</body>

</html>