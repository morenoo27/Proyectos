<?php



session_name("EXAMEN");
session_start();

require_once "src/cte_funciones.php";
define('TITLE', 'SIMULACRO EXAMEN');

if (isset($_POST['login'])) {

    $error_user = $_POST['usuario'] == '';
    $err_pass = $_POST['clave'] == '';

    if (!$error_user && !$err_pass) {

        $url = DIR_SERV . "/login";
        $respuesta = consumir_servicios_REST($url, "post", ["usuario" => $_POST['usuario'], "clave" => md5($_POST['clave'])]);

        $obj = json_decode($respuesta);

        if (!$obj) {

            session_destroy();
            die(error_page(TITLE, "Error consumiento el servicio: $url. <br/>" . $respuesta));
        }

        if (isset($obj->error)) {
            session_destroy();
            die(error_page(TITLE, $obj->error));
        }

        if (isset($obj->mensaje)) {
            $error_user = true;
        } else {
            $_SESSION['usuario'] = $_POST['usuario'];
            $_SESSION['clave'] = md5($_POST['clave']);
            $_SESSION['time'] = time();
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
    <title>SIMULACRO EXAMEN</title>
</head>

<body>
    <h1>SIMULACRO EXAMEN VIDECLUB</h1>

    <?php
    if (isset($_SESSION['usuario'])) {

        require_once "src/seguridad.php";

        require_once "vistas/principal.php";
    } else {
        require_once "vistas/login.php";
    }
    ?>
</body>

</html>