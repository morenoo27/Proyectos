<?php

const SERVIDOR_BD = "localhost";
const NOMBRE_USUARIO = "jose";
const CLAVE = "josefa";
const NOMBRE_BD = "bd_teoria";

function montarSelect(int $nota, int $asignatura)
{

    $select = "<select name='nota$asignatura'>";

    for ($i = 0; $i <= 10; $i++) {
        if ($i == $nota) {
            $select .= "<option value='$i' selected>$i</option>";
        } else {
            $select .= "<option value='$i'>$i</option>";
        }
    }

    $select .= "</select>";

    return $select;
}

function error_page(string $title, string $body)
{
    return '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>' . $title . '</title></head><body><p>' . $body . '</p></body></html>';;
}

function actualizarNota(int $nuevaNota, int $codAsignatura, int $codAlumno, mysqli $conexion)
{
    $consulta = "UPDATE notas SET nota=$nuevaNota WHERE cod_asig=$codAsignatura AND cod_alu=$codAlumno ";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        return true;
    } else {
        return false;
    }
}