<?php
require "ctes_funciones.php";

if (isset($_POST["btnContNuevo"])) {
    $error_cod = $_POST["cod"] == "";
    if (!$error_cod) {
        $url = DIR_SERV . "/repetido/producto/cod/" . urlencode($_POST["cod"]);
        $respuesta = consumir_servicios_REST($url, "GET");
        $obj = json_decode($respuesta);
        if (!$obj) {
            session_destroy();
            die(error_page("CRUD Actividad 2", "<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta));
        }
        if (isset($obj->error)) {
            session_destroy();
            die(error_page("CRUD Actividad 2", "<p>" . $obj->error . "</p>"));
        }
        $error_cod = $obj->repetido;
    }
    $error_nombre = $_POST["nombre"] == "";
    $error_nombre_corto = $_POST["corto"] == "";
    if (!$error_nombre_corto) {
        $url = DIR_SERV . "/repetido/producto/nombre_corto/" . urlencode($_POST["corto"]);
        $respuesta = consumir_servicios_REST($url, "GET");
        $obj = json_decode($respuesta);
        if (!$obj) {
            session_destroy();
            die(error_page("CRUD Actividad 2", "<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta));
        }
        if (isset($obj->error)) {
            session_destroy();
            die(error_page("CRUD Actividad 2", "<p>" . $obj->error . "</p>"));
        }
        $error_nombre_corto = $obj->repetido;
    }
    $error_descripcion = $_POST["descrip"] == "";
    $error_PVP = $_POST["pvp"] == "" || !is_numeric($_POST["pvp"]) || $_POST["pvp"] <= 0;

    $error_form_nuevo = $error_cod || $error_nombre || $error_nombre_corto || $error_descripcion || $error_PVP;

    if (!$error_form_nuevo) {
        $datos["cod"] = $_POST["cod"];
        $datos["nombre"] = $_POST["nombre"];
        $datos["nombre_corto"] = $_POST["corto"];
        $datos["descripcion"] = $_POST["descrip"];
        $datos["PVP"] = $_POST["pvp"];
        $datos["familia"] = $_POST["familia"];
        $url = DIR_SERV . "/insertar";
        $respuesta = consumir_servicios_REST($url, "POST", $datos);
        $obj = json_decode($respuesta);
        if (!$obj) {
            die(error_page("CRUD Actividad 2", "<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta));
        }
        if (isset($obj->error)) {
            die(error_page("CRUD Actividad 2", "<p>" . $obj->error . "</p>"));
        }
        $_SESSION["accion"] = $obj->mensaje;
        header("Location: index.php");
        exit;
    }
}
if (isset($_POST["btnContBorrar"])) {
    $url = DIR_SERV . "/borrar/" . $_POST["btnContBorrar"];
    $respuesta = consumir_servicios_REST($url, "DELETE");
    $obj = json_decode($respuesta);
    if (!$obj) {
        session_destroy();
        die(error_page("CRUD Actividad 2", "<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta));
    }
    if (isset($obj->error)) {
        session_destroy();
        die(error_page("CRUD Actividad 2", "<p>" . $obj->error . "</p>"));
    }
    $_SESSION["accion"] = $obj->mensaje;
    header("Location: index.php");
    exit;
}
if (isset($_POST["btnContEditar"])) {
    //Comprobar errores
    $error_cod = $_POST["cod"] == "";
    if (!$error_cod) {
        $url = DIR_SERV . "/repetido/producto/cod/" . urlencode($_POST["cod"]) . "/cod/" . $_POST["btnContEditar"];
        $respuesta = consumir_servicios_REST($url, "GET");
        $obj = json_decode($respuesta);
        if (!$obj) {
            session_destroy();
            die(error_page("CRUD Actividad 2", "<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta));
        }
        if (isset($obj->error)) {
            session_destroy();
            die(error_page("CRUD Actividad 2", "<p>" . $obj->error . "</p>"));
        }
        $error_cod = $obj->repetido;
    }
    $error_nombre = $_POST["nombre"] == "";
    $error_nombre_corto = $_POST["corto"] == "";
    if (!$error_nombre_corto) {
        $url = DIR_SERV . "/repetido/producto/nombre_corto/" . urlencode($_POST["corto"]) . "/cod/" . $_POST["btnContEditar"];
        $respuesta = consumir_servicios_REST($url, "GET");
        $obj = json_decode($respuesta);
        if (!$obj) {
            session_destroy();
            die(error_page("CRUD Actividad 2", "<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta));
        }
        if (isset($obj->error)) {
            session_destroy();
            die(error_page("CRUD Actividad 2", "<p>" . $obj->error . "</p>"));
        }
        $error_nombre_corto = $obj->repetido;
    }
    $error_descripcion = $_POST["descrip"] == "";
    $error_PVP = $_POST["pvp"] == "" || !is_numeric($_POST["pvp"]) || $_POST["pvp"] <= 0;

    $error_form_editar = $error_cod || $error_nombre || $error_nombre_corto || $error_descripcion || $error_PVP;

    $datos["cod"] = $_POST["cod"];
    $datos["nombre"] = $_POST["nombre"];
    $datos["nombre_corto"] = $_POST["corto"];
    $datos["descripcion"] = $_POST["descrip"];
    $datos["PVP"] = $_POST["pvp"];
    $datos["familia"] = $_POST["familia"];

    if (!$error_form_editar) {
        $url = DIR_SERV . "/actualizar/" . $_POST["btnContEditar"];
        $respuesta = consumir_servicios_REST($url, "PUT", $datos);
        $obj = json_decode($respuesta);
        if (!$obj) {
            die(error_page("CRUD Actividad 2", "<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta));
        }
        if (isset($obj->error)) {
            die(error_page("CRUD Actividad 2", "<p>" . $obj->error . "</p>"));
        }
        $_SESSION["accion"] = $obj->mensaje;
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD con sw</title>
    <style>
        table,
        td,
        th {
            border: 1px solid black;
            text-align: center;
        }

        th {
            background-color: #CCC;
        }

        table {
            border-collapse: collapse;
        }

        .linea {
            display: inline;
        }

        .enlace {
            background-color: transparent;
            border: none;
            text-decoration: underline;
            cursor: pointer;
            color: blue;
        }

        .formulario {
            border: 0px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h1>Tienda Online</h1>
    <?php
    if (isset($_POST["btnListar"])) {
        require "vistas/vista_listar.php";
    }
    if (isset($_POST["btnBorrar"])) {
        require "vistas/vista_borrar.php";
    }
    if (isset($_POST["btnEditar"]) || (isset($_POST["btnContEditar"])) && $error_form_editar) {
        require "vistas/vista_editar.php";
    }
    if (isset($_POST["btnNuevo"]) || (isset($_POST["btnContNuevo"])) && $error_form_nuevo) {
        require "vistas/vista_nuevo.php";
    }
    if (isset($_SESSION["accion"])) {
        echo "<p>" . $_SESSION["accion"] . "</p>";
        unset($_SESSION["accion"]);
    }

    require "vistas/vista_principal.php";
    ?>
</body>

</html>