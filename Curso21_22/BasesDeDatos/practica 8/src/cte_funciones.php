<?php
define("SERVIDOR_BD", "localhost");
define("USUARIO_BD", "jose");
define("CLAVE_BD", "josefa");
define("NOMBRE_BD", "bd_cv");
define("RUTANOIMAGEN", "imagenes/no_imagen.jpg");

function error_page($title, $body)
{
    $html = '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0">';
    $html .= '<title>' . $title . '</title></head>';
    $html .= '<body><p>' . $body . '</p></body></html>';
    return $html;
}

function repetido($conexion, $tabla, $columna, $valor_colum, $primary_key = null, $valor_pk = null)
{
    if (isset($primary_key))
        $consulta = "select " . $columna . " from " . $tabla . " where " . $columna . "='" . $valor_colum . "' and " . $primary_key . "<>'" . $valor_pk . "'";
    else
        $consulta = "select " . $columna . " from " . $tabla . " where " . $columna . "='" . $valor_colum . "'";

    $resultado = mysqli_query($conexion, $consulta);
    if ($resultado) {
        $respuesta = mysqli_num_rows($resultado) > 0;
        mysqli_free_result($resultado);
    } else
        $respuesta["error"] = "Imposible realizar la consulta. Nº" . mysqli_errno($conexion) . " : " . mysqli_error($conexion);

    return $respuesta;
}

function isValid($dniCompleto)
{
    if (strlen($_POST["dniCREAR"]) == 9) {
        $dni = substr($dniCompleto, 0, 8);
        $letra = strtoupper(substr($dniCompleto, -1));

        //si la letra es numerica, significa que no es una letra sino un numero(no hay letra)
        if ($letra >= "A" && $letra <= "Z") {
            $letraCorrespondiente = substr("TRWAGMYFPDXBNJZSQVHLCKEO", $dni % 23, 1);
            return $letra == $letraCorrespondiente; //determianmos si el dni es correcto
        } else {
            return false;
        }
    }
    return false;
}

function salto_con_POST($ruta, $name)
{
    echo "<html><body onload='document.form_post.submit();'>";
    echo "<form action='" . $ruta . "' method='post' name='form_post'><input type='hidden' name='" . $name . "' value=''/></form>";
    echo "</body></html>";
}

function insertarUsuario(\mysqli $conexion, string $usuario, string $nombre, string $clave, string $sexo, string $dni)
{
    //creamos y ejecutamos query
    $consulta = "INSERT INTO usuarios (usuario, clave, nombre, dni, sexo) values ('$usuario', '$clave', '$nombre', '$sexo', '$dni')";
    $respuesta = mysqli_query($conexion, $consulta);
    //si se ejecuta correctamente saltamos a index de manera normal
    if ($respuesta) {
        mysqli_close($conexion);
        salto_con_POST("index.php", "insertado");
    } else {
        die(error_page("FALLO EN LA INSERCION", "Fallo nº:" . mysqli_connect_errno($conexion) . ": " . mysqli_connect_error($conexion)));
    }
}
