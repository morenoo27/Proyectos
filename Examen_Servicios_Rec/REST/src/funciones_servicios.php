<?php
require "config_bd.php";


define("ERROR", "Imposible conectar en la base de datos. ");
define("ERRORCONEX", "Error en la conexion de la base de datos. Error ");
define("MENSAJE", "BUSQUEDA NO ENCONTRADA EN LA BASE DE DATOS ");

function login(string $usuario, string $clave)
{

    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

        $consulta = "SELECT * FROM usuarios WHERE usuario=? AND clave=?";
        $sentencia = $conexion->prepare($consulta);

        if ($sentencia->execute([$usuario, $clave])) {

            if ($sentencia->rowCount() > 0) {

                $respuesta['usuario'] = $sentencia->fetch(PDO::FETCH_ASSOC);
            } else {
                $respuesta['mensaje'] = MENSAJE;
            }

            $sentencia = null;
            $conexion = null;
        } else {
            $respuesta['error'] = ERRORCONEX . $sentencia->errorInfo()[1] . ": " . $sentencia->errorInfo()[2];
        }
    } catch (PDOException $e) {
        $respuesta['error'] = ERROR . $e->getMessage();
    }

    return $respuesta;
}
