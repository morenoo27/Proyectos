<?php
$datos["usuario"] = $_SESSION["usuario"];
$datos["clave"] = $_SESSION["clave"];
$url = DIR_SERV . "/login";
$respuesta = consumir_servicios_REST($url, "POST", $datos);
$obj = json_decode($respuesta);

if (!$obj) {

    session_destroy();
    die(error_page("Gestion Guardias", "<p>Error al consumir el servicio: " . $url . "</p>" . $respuesta));
}

if (isset($obj->error)) {

    session_destroy();
    die(error_page("Gestion Guardias", "<p>" . $obj->mensaje . "</p>"));
}


if (isset($obj->usuario)) {

    if (time() - $_SESSION["ultimo_acceso"] > MINUTOS * 60) {

        session_unset();
        $_SESSION["seguridad"] = "Tiempo de sesión caducado. Registrese o logueese de nuevo.";
        header("Location:index.php");
        exit;
    }
} else {

    session_unset();
    $_SESSION["seguridad"] = "Zona restringida. Vuelva a loguearse";
    header("Location:index.php");
    exit;
}

$datos_usuario_log = $obj->usuario;
$_SESSION["ultimo_acceso"] = time();
