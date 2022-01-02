<?php 

define("SERVIDOR_BD", "localhost");
define("USUARIO_BD", "jose");
define("CLAVE_BD", "josefa");
define("NOMBRE_BD", "videoclub_exam");
define("RUTANOIMAGEN", "imagenes/no_imagen.jpg");

function error_page($title, $body)
{
    $html = '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0">';
    $html .= '<title>' . $title . '</title></head>';
    $html .= '<body><p>' . $body . '</p></body></html>';
    return $html;
}