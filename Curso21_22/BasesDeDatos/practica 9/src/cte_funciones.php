<?php
define("SERVIDOR_BD", "localhost");
define("USUARIO_BD", "jose");
define("CLAVE_BD", "josefa");
define("NOMBRE_BD", "bd_videoclub");

function listarTabla(mysqli $conexion, string $tabla)
{
    $consulta = "SELECT * FROM $tabla";

    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {

        $tabla = "";

        if (mysqli_num_rows($resultado) > 0) {

            while ($datos = mysqli_fetch_assoc($resultado)) {

                $tabla .= "<tr>";
                $tabla .= "<td>" . $datos["idPelicula"] . "</td>";
                $tabla .= "<td><img class='imagen' src='imagenes/" . $datos["caratula"] . "' alt='caratula de la pelicula'></td>";
                $tabla .= '<td><form action="index.php" method="post"><input type="hidden" name="idListar" value="' . $datos["idPelicula"] . '"><button type="submit" class="sin_boton" name="listarUsaurio">' . $datos["titulo"] . '</button></form></td>';
                $tabla .= '<td><form action="index.php" method="post"><input type="hidden" name="idEditarBorrar" value="' . $datos["idPelicula"] . '"><button type="submit" class="sin_boton" name="editarUsuario">Editar</button> - <button type="submit" class="sin_boton name="borarUsuario">Borrar</button></form></td>';
                $tabla .= "<tr/>";
            }
        } else {
            $tabla = "<tr><td colspan='4'> Tabla sin datos todavia </td></tr>";
        }

        return $tabla;
    } else {

        $numEr = mysqli_errno($conexion);
        $Error = mysqli_error($conexion);
        mysqli_close($conexion);

        return "<tr><td colspan='4' class='error'>*Error en la consulta a la base de datos. Error Nº:$numEr. $Error*</td></tr>";
    }
}

function error_page($title, $body)
{
    $html = '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0">';
    $html .= '<title>' . $title . '</title></head>';
    $html .= '<body><p>' . $body . '</p></body></html>';
    return $html;
}

function insertIntoPelis(mysqli $conexion, string $titulo, string $director, string $tematica, string $sinopsis)
{

    $consulta = "INSERT INTO peliculas (titulo, director, sinopsis, tematica) VALUES ('$titulo', '$director', '$sinopsis', '$tematica')";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {

        return true;
    } else {
        return false;
    }
}

//MIRAR COMO SUBIR FOTO
/**
 * Metodo que actualiza el valor de la imagen en una base de datos con cuna conexion
 */
function actualizarFotoTablaPeliculas(mysqli $conexion, array $file, int $id)
{
    //obtenemos el nombre de la imagen
    $foto = explode('.', $file['name']);

    $nombreArchivo = $foto[0];

    $nombre = "img" . $id;
    $extension = "";

    if ($nombreArchivo != end($foto)) {
        $extension = end($foto);

        $directorio = "$nombre.$extension";
    } else {

        $directorio = "$nombre";
    }

    $fd = move_uploaded_file($file["tmp_name"], "imagenes/$directorio");

    if ($fd) {
        //realizamos la consulta
        $consulta = "UPDATE peliculas set caratula='$directorio' WHERE idPelicula='$id'";
        $resultado = mysqli_query($conexion, $consulta);
        if ($resultado) {
            return true;
        } else {
            return false;
        }
        
    } else {
        die(error_page("FALLO EN SUBIDA DE ARCHIVO", "<p>Fallo en la subida del archivo por falta de permisos</p>"));
    }
    
}

function purgarBD(mysqli $conexion, $tabla)
{
    $consulta = "ALTER TABLE $tabla AUTO_INCREMENT=0";
    $resultado1 = mysqli_query($conexion, $consulta);
    if ($resultado1) {

        $consulta2 = "DELETE FROM $tabla";
        $resultado2 = mysqli_query($conexion, $consulta2);

        if ($resultado2) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
