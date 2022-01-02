<?php

session_name("examen3_21_22");
session_start();

if (isset($_SESSION["usuario"])) {


    if (isset($_POST["cerrarSesion"])) {

        session_destroy();
        header("Location:../index.php");
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gestion libros</title>
    </head>

    <body>
        <p>
            <span>Bienvenido Administrador</span>
        <form action="gest_libros.php" method="post">
            <button type="submit" name="cerrarSesion">Salir</button>
        </form>
        </p>
    </body>

    </html>

<?php
} else {
    $_SESSION["restringido"] = "<span class='error'>*accediendo a sitio restringido. Por favor, logueese*</span>";
    header("Location:../index.php");
    exit;
}
?>