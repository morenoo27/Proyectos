<?php
require "src/ctes_funciones.php";

define("FALLOCONSULTA", "Error al consumir el servicio: Error ");
DEFINE("FALLOCONEXION", "Imposioble coniectar. ");

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
                $respuesta['mensaje'] = "Usuario no se encuentra registrado en la BD";
            }
        } else {
            $respuesta['error'] = FALLOCONSULTA . $sentencia->errorInfo()[1] . ": " . $sentencia->errorInfo()[2];
        }

        $sentencia = null;
        $conexion = null;
    } catch (PDOException $e) {
        $respuesta['error'] = FALLOCONEXION . $e->getMessage();
    }

    return $respuesta;
}

function horario($dia, $hora)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

        $consulta = "SELECT * FROM usuarios JOIN horario_lectivo ON usuarios.id_usuario = horario_lectivo.usuario WHERE dia=? AND hora=? AND grupo=51";
        $sentencia = $conexion->prepare($consulta);

        if ($sentencia->execute([$dia, $hora])) {

            //MAS DE UNA RESPUESTA => FETCHALL
            $respuesta['usuario'] = $sentencia->fetchAll();

            $respuesta['cantidad'] = $sentencia->rowCount();
        } else {

            $respuesta['error'] = FALLOCONSULTA . $sentencia->errorInfo()[1] . ": " . $sentencia->errorInfo()[2];
        }
    } catch (PDOException $e) {
        $respuesta['error'] = FALLOCONEXION . $e->getMessage();
    }

    return $respuesta;
}

function deGuardia($dia, $hora, $id)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

        $consulta = "SELECT * FROM usuarios JOIN horario_lectivo ON usuarios.id_usuario = horario_lectivo.usuario WHERE dia=? AND hora=? AND horario_lectivo.usuario=?";
        $sentencia = $conexion->prepare($consulta);

        if ($sentencia->execute([$dia, $hora, $id])) {

            if ($sentencia->rowCount() > 0) {
                $respuesta['usuario'] = $sentencia->fetch(PDO::FETCH_ASSOC);
            } else {
                $respuesta['mensaje'] = "Usuario no se encuentra registrado en la BD";
            }
        } else {

            $respuesta['error'] = FALLOCONSULTA . $sentencia->errorInfo()[1] . ": " . $sentencia->errorInfo()[2];
        }
    } catch (PDOException $e) {
        $respuesta['error'] = FALLOCONEXION . $e->getMessage();
    }

    return $respuesta;
}
