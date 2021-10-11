<?php
if (isset($_POST["btnSubir"])) {
    //miramos errores
    /*
    En un typo file se mira por $_FILES no por $_POST
    $_FILES["name"]["name"] --> nombre del archivo
    $_FILES["name"]["tmp_name"] --> ruta temporal del archivo
    $_FILES["name"]["type"] --> tipo del archivo
    $_FILES["name"]["size"] --> tamaño del archivo
    $_FILES["name"]["error"] --> si ha habido un error en la subida del archivo
    */

    $errorFoto = $_FILES["pic"]["name"] == "" || $_FILES["pic"]["error"]  || !getimagesize($_FILES["pic"]["tmp_name"]) || $_FILES["pic"]["size"] > 500 * 1000;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Formulario - Subir imagenes</h1>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="foto">Seleccione una imagen no superior a 500KB</label>
            <input type="file" name="pic" id="foto" accept="image/*">
            <?php
            if (isset($_POST["btnSubir"]) && $errorFoto) {
                switch ($_FILES["pic"]) {
                    case $_FILES["pic"]["error"];
                        echo "Error en la subida";
                        break;
                    case !getimagesize($_FILES["pic"]["tmp_name"]);
                        echo "El archivo no es una imagen";
                        break;
                    case $_FILES["pic"]["size"] > 500 * 1000;
                        echo "Imagen de mayor tamaño";
                        break;
                }
            }
            ?>
        </p>

        <p>
            <input type="submit" value="Subir imagen" name="btnSubir">
        </p>

    </form>

    <?php
    if (isset($_POST["btnSubir"]) && !$errorFoto) {
        echo "<h1>Informacion de la imagen subida:</h1>";
        echo "<p><strong>Nombre de la imagen: </strong>" . $_FILES["pic"]["name"] . "</p>";
        echo "<p><strong>Direccion temporal del archivo: </strong>" . $_FILES["pic"]["tmp_name"] . "</p>";
        echo "<p><strong>Tamaño del arrchivo: </strong>" . $_FILES["pic"]["size"] . " bytes</p>";
        echo "<p><strong>Extension del archivo: </strong>" . $_FILES["pic"]["type"] . "</p>";

        $arrFoto = explode(".", $_FILES["pic"]["name"]);
        $extension = end($arrFoto);
        if ($extension == $_FILES["pic"]["name"]) {
            $extension = "";
        }
        $nombre = md5(uniqid(uniqid(), true));

        $var = move_uploaded_file($_FILES["pic"]["tmp_name"],"images/$nombre.$extension");

    }
    ?>

</body>

</html>