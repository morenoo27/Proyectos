<?php

require "src/cte_funciones.php";
/* DECLARACION DE VARIABLES NECESARIAS */
$insertado = false;
$purgado = false;
$editado = false;
$updateFoto = false;


/* CONEXION CON BASE DE DATOS */
@$conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
if (!$conexion) {
    die(error_page("Fallo en conexion", "<p>Fallo en la conexion a la base de datos. Error Nº:" . mysqli_connect_errno() . ". " . mysqli_connect_error() . "</p>"));
}

/* ERRORES INSERTAR */
if (isset($_POST["insertarPelicula"])) {

    $errorTitulo = $_POST["tituloPeli"] == "";
    $errorDirector = $_POST["directorPeli"] == "";
    $errorTemática = $_POST["tematicaPeli"] == "";
    $errorSinopsis = $_POST["sinopsisPeli"] == "";
    $errorFoto = $_FILES["fotoPeli"]["name"] != "" && ($_FILES["fotoPeli"]["error"] || !getimagesize($_FILES["fotoPeli"]["tmp_name"]) || $_FILES["fotoPeli"]["size"] > 10 * 1000000);

    $errores = $errorTitulo || $errorDirector || $errorTemática || $errorSinopsis || $errorFoto;

    if (!$errores) {
        /* INSERTA DATOS */
        $insertado = insertIntoPelis($conexion, $_POST["tituloPeli"], $_POST["directorPeli"], $_POST["tematicaPeli"], $_POST["sinopsisPeli"]);

        if (!$insertado) {
            die(error_page("Fallo en conexion", "<p>Fallo en la conexion a la base de datos. Error Nº:" . mysqli_errno($conexion) . ". " . mysqli_error($conexion) . "</p>"));
        }

        if ($_FILES["fotoPeli"]["name"] != "") {

            $id = mysqli_insert_id($conexion);

            $updateFoto = actualizarFotoTablaPeliculas($conexion, $_FILES["fotoPeli"], $id);

            if (!$updateFoto) {
                $numError = mysqli_errno($conexion);
                $error = mysqli_error($conexion);
                die(error_page("ERROR EN LA ACTUALIZACION", "<p>Error en la subnida del archivo. Error Nº:$numError. $error</p>"));
            }
        }
    }
}

if (isset($_POST["purgar"])) {
    $purgado = purgarBD($conexion, "peliculas");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRACTICA 9</title>

    <style>
        * {
            font-family: Verdana, sans-serif;

        }

        .textoCentrado {
            text-align: center;
        }

        .sin_boton {
            background: transparent;
            border: none;
            color: blue;
            text-decoration: underline;
            cursor: pointer
        }

        .error {
            color: red;
        }

        .exito {
            color: blue;
        }

        .imagen {
            width: 100px;
        }
    </style>
</head>

<body>

    <h1>Video Club</h1>
    <h2>Películas</h2>
    <h3>Listado de películas</h3>

    <?php
    if ($insertado) {
        echo "<span class='exito' >Usuario insertado con exito</span><br>";
    }

    if ($updateFoto) {
        echo "<span class='exito'>Foto insertada con exito</span><br>";
    }

    if ($purgado) {
        echo "<span class='exito'>Base de datos reiniciada</span><br>";
    }
    ?>

    <form action="index.php" method="post">
        <button type="submit" name="purgar" class="error">Borrar elementos de la base de datos</button>
    </form>
    <table border="1" class="textoCentrado">
        <tr>
            <th>ID</th>
            <th>Carátula</th>
            <th>Título</th>
            <th>
                <form action="index.php" method="post"><button type="submit" name="CREARPelicula" class="sin_boton">Pelicula+</button></form>
            </th>
        </tr>
        <?php echo listarTabla($conexion, "peliculas") ?>
    </table>

    <?php
    if (isset($_POST["CREARPelicula"]) || (isset($_POST["insertarPelicula"]) && $errores)) {
        require "vistas/insertar.php";
    }

    if (isset($_POST["listarUsaurio"])) {

        $prueba = "hola";

        require "vistas/listar.php";
    }
    ?>

</body>

</html>