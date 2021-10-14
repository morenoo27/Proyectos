<!DOCTYPE html>
<html lang="en">

<head>

    <title>Datos</title>
</head>

<body>
    <?php

    echo "<h3>Datos recibidos:</h3>";

    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $pass = $_POST["pass"];
    $dni = $_POST["dni"];
    $comentarios = $_POST["cometarios"];

    echo "<p><strong>Nombre: </strong>" . $nombre . "</p>";
    echo "<p><strong>Apellidos: </strong>" . $apellidos . "</p>";
    echo "<p><strong>Contraseña: </strong>" . $pass . "</p>";
    echo "<p><strong>DNI: </strong>" . $dni . "</p>";

    if (isset($_POST["sexo"])) {
        $sexo = $_POST["sexo"];
        echo "<p><strong>Sexo: </strong>" . $sexo . "</p>";
    }
    if (isset($_POST["subs"])) {
        echo "<p>Si ";
    } else {
        echo "<p>No ";
    };

    echo "esta suscrito </p>";

    echo "<p>Comentarios: " . $comentarios . "</p>";

    //sino mostramos la pagina de nuevo

    ?>
</body>

</html>