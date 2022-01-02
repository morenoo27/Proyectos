<?php

require "src/cte_funciones.php";

session_name("examen3_21_22");
session_start();

//conecxion con base de datos
$conexion = mysqli_connect(SERVIDOR, USUARIO, CLAVE, NOMBRE);

//CONTROL FALLO DE CONEXION
if (!$conexion) {
    $numerr = mysqli_connect_errno();
    $err = mysqli_connect_error();
    die(error_page("Examen tema 4", "Error en la conexion a la base de datos. Error Nº:$numerr: $err"));
}

if (isset($_POST["login"])) {
    //miramos errores del formulario

    $errorUsuario = $_POST["usuario"] == "";
    $errorContraseña = $_POST["pass"] == "";

    $vacios = $errorUsuario || $errorContraseña;

    //INICIO DE SESION
    if (!$vacios) {

        //CONSULTA
        $consulta = "SELECT * FROM usuarios WHERE lector='" . $_POST["usuario"] . "'" . " AND clave='" . md5($_POST["pass"]) . "'";
        $resultado = mysqli_query($conexion, $consulta);

        //CONTROL FALLO EN QUERY
        if (!$resultado) {
            $numerr = mysqli_errno($conexion);
            $err = mysqli_error($conexion);
            die(error_page("Examen tema 4", "Error en la consulta a la base de datos. Error Nº:$numerr: $err"));
        }

        //encuentra
        if (mysqli_num_rows($resultado) > 0) {

            //OBTENCION DE DATOS
            $datos = mysqli_fetch_assoc($resultado);

            //LIBERACION DE MEMORIA
            mysqli_free_result($resultado);

            //INSTANCIA DE SESION
            $_SESSION["usuario"] = $_POST["usuario"];
            $_SESSION["clave"] = $_POST["pass"];
            $_SESSION["tipo"] = $datos["tipo"];
            $_SESSION["tiempo"] = time();
        } else {

            //si no encuentra significa que no hay usaurios con esas credenciales
            $errorInicio = true;
        }
    }
}

if (isset($_POST["cerrarSesion"])) {

    unset($_POST["cerrarSesion"]);
    session_destroy();
    header("Location:index.php");
}

if (isset($_POST["accion"])) {

    $tiempoactual = time();

    $timepoTranscurrido = $tiempoactual - $_SESSION["tiempo"];

    if ($timepoTranscurrido > (INACTIVIDAD * 60)) {

        $_SESSION["restringido"] = "<span class='error'>*Timepo inactivo sobrepasado, logueese de nuevo*</span>";

        unset($_SESSION["usuario"]);
        header("Location:index.php");
        exit;
    } else {
        $_SESSION["accion"] = "<span >*Realiza accion*</span>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen Tema 4</title>
    <style>
        .fotos {
            display: flex;
            flex-flow: row wrap;
        }

        .libro {
            width: 30%;
            text-align: center;
        }

        img {
            width: 100%;
        }
    </style>
</head>

<body>
    <h1>Librería</h1>
    <?php
    if (isset($_SESSION["usuario"])) {

        if ($_SESSION["tipo"] == "admin") {
            header("Location:admin/gest_libros.php");
            exit;
        } else {
            require "vistas/usuario.php";
        }
    } else {
        require "vistas/login.php";
    }

    echo "<div class='fotos'>";
    require "vistas/libros.php";
    echo "</div>";
    mysqli_close($conexion);
    ?>
</body>

</html>