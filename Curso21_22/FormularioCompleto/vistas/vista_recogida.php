<!DOCTYPE html>
<html lang="en">

<head>

    <title>Datos</title>
</head>

<body>
    <?php

    echo "<h3>Datos recibidos:</h3>";

    $nombre = $_POST["nombre"];
    $usuario = $_POST["usuario"];
    $pass = $_POST["contra"];
    $dni = $_POST["dni"];

    echo "<p><strong>Nombre: </strong>" . $nombre . "</p>";
    echo "<p><strong>Usuario: </strong>" . $usuario . "</p>";
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

    if ($_FILES["foto"]["name"] != "") {
        echo "<h3>Informacion de la imagen seleccionada</h3>";
        echo "<p><strong>Nombre de la imagen: </strong>" . $_FILES["foto"]["name"] . "</p>";
        echo "<p><strong>Direccion temporal del archivo: </strong>" . $_FILES["foto"]["tmp_name"] . "</p>";
        echo "<p><strong>Tamaño del arrchivo: </strong>" . $_FILES["foto"]["size"] . " bytes</p>";
        echo "<p><strong>Extension del archivo: </strong>" . $_FILES["foto"]["type"] . "</p>";

        $arrFoto = explode(".", $_FILES["foto"]["name"]);
        
        $extension = "";
        if ($extension != $_FILES["foto"]["name"]) {
            $extension = "." . end($arrFoto);
        }

        $nombre = md5(uniqid(uniqid(), true));

        $warning = move_uploaded_file($_FILES["foto"]["tmp_name"], "imagenes/$nombre$extension");
        if ($warning) {
            echo "<p>Imagen subida con exito</p>";
            echo "<img src='imagenes/$nombre$extension'>";
        } else {
            echo "<p>La imagen no se ha podido copiar en a carpeta por falta de permisos</p>";
        }
    }
    ?>

</body>

</html>