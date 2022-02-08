<?php

require_once "src/cte_funciones.php";

session_name('EXAMEN');
session_start();

if (isset($_POST['login'])) {
    # control login
    $error_user = $_POST['usuario'] == '';
    $error_pass = $_POST['clave'] == '';

    if (!$error_user && !$error_pass) {

        $url = DIR_SERV . '/login';

        $respuesta = consumir_servicios_REST($url, 'post', ["usuario" => $_POST['usuario'], 'clave' => md5($_POST['clave'])]);

        $obj = json_decode($respuesta);
        if (!$obj) {

            session_destroy();
            die(error_page(TITULO, "Error al consuymir el servicio $url <br /> $respuesta"));
        }

        if (isset($obj->error)) {
            session_destroy();
            die(error_page(TITULO, $obj->error));
        }

        if (isset($obj->mensaje)) {
            
            $error_user = true;
        } else {
            $_SESSION['usuario'] = $_POST['usuario'];
            $_SESSION['clave'] = md5($_POST['clave']);
            $_SESSION['time'] = time();

            header("Location:index.php");
            exit;
        }
    }
}

if (isset($_POST['salir'])) {

    session_destroy();
    header("Location:index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONTROL GUARDIAS</title>
</head>

<body>
    <h1>CONTROL GUARDIAS</h1>

    <?php
    if (isset($_SESSION['usuario'])) {

        require_once "vistas/listar.php";
    } else {

        require_once "vistas/login.php";
    }

    ?>

</body>

</html>