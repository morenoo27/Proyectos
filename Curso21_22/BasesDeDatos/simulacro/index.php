<?php
require "src/cte_funciones.php";

//VARIABLES NECESARIAS
$notaActualizada = false;

$conexion = mysqli_connect(SERVIDOR_BD, NOMBRE_USUARIO, CLAVE, NOMBRE_BD);
if (!$conexion) {
    $fallo = mysqli_connect_errno();
    $error = mysqli_connect_error();

    die(error_page("Fallo en la conexion", "Fallo Nº: $fallo. $error"));
}

if (isset($_POST["cambiarNota"])) {

    $numeroAsignatura = $_POST['numAsig'];
    $indice = "nota$numeroAsignatura";

    $notaActualizada = actualizarNota($_POST["$indice"], $_POST["idAsig"], $_POST["idAlumno"], $conexion);

    if (!$notaActualizada) {

        $fallo = mysqli_errno($conexion);
        $error = mysqli_error($conexion);

        die(error_page("Fallo en conexion", "fallo en el acceso a los datos del alumno. Error Nº: $fallo. $error"));
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMULACRO EXAMEN</title>
    <style>
        .conBorde {
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <h1>Practica Nueva de Clase</h1>
    <?php
    if ($notaActualizada) {
        echo "<p class='exito'>Nota del alumno actualizada</>";
    }
    require "vistas/listado_alumnos.php";

    if (isset($_POST["listarAlumno"]) || isset($_POST["cambiarNota"])) {
        require "vistas/listar_alumno.php";
    }
    ?>


</body>

</html>