<?php

require "../../src/cte_funciones.php";

session_name("simulacro");
session_start();

//CONTROL DE SESION ACTIVA
if (isset($_SESSION["usuario"]) && isset($_SESSION["clave"]) && isset($_SESSION["ultima_conexion"])) {

    //BANEO
    $conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);

    //CERRADO DE SESION
    if (isset($_POST["salir"])) {

        session_destroy();
        header("Location:../../index.php");
        exit;
    }

    if (isset($_POST[""])) {
        # code...
    }

    # MOSTRAMOS PAGINA
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="stilosclientes.css">
        <title>VideoClub Examen</title>

    </head>

    <body>

        <?php
        if ($tipo == "admin") {
            require "admin.php";
        } else {
            
            require "normal.php";
        }
        ?>


    </body>

    </html>
<?php

} else {

    $_SESSION["restringido"] = "Estas accediendo a una zona restringida, logueese por favor. Gracias";

    header("Location:../../");
    exit;
}
