<?php

const SERVIDOR = "localhost";
const USUARIO = "jose";
const CLAVE = "josefa";
const NOMBRE = "bd_libreria_exam";
const INACTIVIDAD = 2;//MINUTOS

function error_page($title, $body)
{
    $html = '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0">';
    $html .= '<title>' . $title . '</title></head>';
    $html .= '<body>' . $body . '</body></html>';
    return $html;
}
