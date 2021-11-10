<?php


/**
 * Funcion que comprueba si existe un registro en una columna de una tabla determinada
 */
function estaEnUso(mysqli $conexion, string $tabla, string $columna, string $valor)
{
    $consulta = "select * from $tabla where $columna=$valor";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        //miramos las tuplas que ha tenido la query, si tiene 0, ese nombre es valuido, sino no es valido
        $respuesta = mysqli_num_rows($resultado) > 0;
        mysqli_free_result($resultado);
        return $respuesta;
    } else {
        $respuesta["error"] = "imposible realizar la consutla. Error Nº: " . mysqli_errno($conexion) . ": " . mysqli_error($conexion);
        return $respuesta;
    }
}

function salto_con_POST($ruta, $name)
{
    echo "<html><body onload='document.form_post.submit();'>";
    echo "<form action='" . $ruta . "' method='post' name='form_post'><input type='hidden' name='" . $name . "' value=''/></form>";
    echo "</body></html>";
}

function error_page($title, $body)
{
    return '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>' . $title . '</title></head><body>' . $body . '</body></html>';;
}
