<?php
require "config_bd.php";

function conexion_pdo()
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

        $respuesta["mensaje"] = "Conexión a la BD realizada con éxito";

        $conexion = null;
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage();
    }
    return $respuesta;
}


function conexion_mysqli()
{
    @$conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
    if (!$conexion)
        $respuesta["error"] = "Imposible conectar:" . mysqli_connect_errno() . " : " . mysqli_connect_error();
    else {
        mysqli_set_charset($conexion, "utf8");
        $respuesta["mensaje"] = "Conexión a la BD realizada con éxito";
        mysqli_close($conexion);
    }
    return $respuesta;
}

function login($usuario, $clave)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

        $consulta = "SELECT * FROM usuarios WHERE usuario=? AND clave=?";

        $sentencia = $conexion->prepare($consulta);

        if ($sentencia->execute([$usuario, $clave])) {

            if ($sentencia->rowCount() > 0) {
                $respuesta['usuario'] = $sentencia->fetch(PDO::FETCH_ASSOC);
            } else {
                $respuesta['mensaje'] = "no se encuentra usuario en BD";
            }
        } else {
            $respuesta["error"] = "ERROR EN LA CONSULTA";
        }

        $sentencia = null;
        $conexion = null;
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage();
    }

    return $respuesta;
}

function horarioUser($id)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

        $consulta = "SELECT dia, hora, grupos.nombre as grupo FROM horario_lectivo JOIN usuarios ON horario_lectivo.usuario=usuarios.id_usuario JOIN grupos ON horario_lectivo.grupo=grupos.id_grupo WHERE usuarios.id_usuario=?";

        $sentencia = $conexion->prepare($consulta);

        if ($sentencia->execute([$id])) {

            $respuesta['horario'] = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $respuesta["error"] = "ERROR EN LA CONSULTA";
        }

        $sentencia = null;
        $conexion = null;
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage();
    }

    return $respuesta;
}

function getUsers()
{

    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

        $consulta = "SELECT * FROM usuarios WHERE tipo='normal'";

        $sentencia = $conexion->prepare($consulta);

        if ($sentencia->execute()) {

            $respuesta['usuarios'] = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $respuesta["error"] = "ERROR EN LA CONSULTA";
        }

        $sentencia = null;
        $conexion = null;
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage();
    }

    return $respuesta;
}

function tieneGrupo($dia, $hora, $id)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

        $consulta = "SELECT * FROM grupos JOIN horario_lectivo ON grupos.id_grupo=horario_lectivo.grupo WHERE horario_lectivo.dia=? AND horario_lectivo.hora=? AND horario_lectivo.usuario=? ";

        $sentencia = $conexion->prepare($consulta);

        if ($sentencia->execute([$dia, $hora, $id])) {

            if ($sentencia->rowCount() > 0) {
                $respuesta['tiene_grupo'] = true;
            } else {
                $respuesta['tiene_grupo'] = false;
            }
        } else {
            $respuesta["error"] = "ERROR EN LA CONSULTA";
        }

        $sentencia = null;
        $conexion = null;
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage();
    }

    return $respuesta;
}

function grupos($dia, $hora, $id)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

        $consulta = "SELECT * FROM grupos JOIN horario_lectivo ON grupos.id_grupo=horario_lectivo.grupo WHERE horario_lectivo.dia=? AND horario_lectivo.hora=? AND horario_lectivo.usuario=? ";

        $sentencia = $conexion->prepare($consulta);

        if ($sentencia->execute([$dia, $hora, $id])) {

            $respuesta['grupos'] = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $respuesta["error"] = "ERROR EN LA CONSULTA";
        }

        $sentencia = null;
        $conexion = null;
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage();
    }

    return $respuesta;
}

function gruposLibres($dia, $hora, $id)
{
    # code...
}
