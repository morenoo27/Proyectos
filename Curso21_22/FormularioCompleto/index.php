<?php


/*
Como llamo a esas variables en el codigo html, primero 
las inicializo a false para la vez en la que abrimos 
por primera vez el archivo no salte un error
*/
$errorNombre = false;
$errorUsuario = false;
$errorContra = false;
$errorDNI = false;
$errorSexo = false;
$errorFoto = false;

//inicializamos este valor para el sexo
$sexo = "";

//para borrar todos los campos

/* Realmente lo que hacemos es quitar que sea un tipo reset, 
que sea submint y si se pulsa (isset) pues recargamos la 
pagina redirigiendola a la misma*/
if (isset($_POST["borrar"])) {
    header("Location:index.php");
    exit;
}

/*Primero vemos que se haya pulsado el bootn de enviar*/
if (isset($_POST["enviar"])) {

    //comprobamos los errores
    $errorNombre = $_POST["nombre"] == "";
    $errorUsuario = $_POST["usuario"] == "";
    $errorContra = $_POST["contra"] == "";
    $errorDNI = $_POST["dni"] == "" || strlen($_POST["dni"]) != 9 || !isValid($_POST["dni"]);
    $errorSexo = !isset($_POST["sexo"]);

    //cuando este instanciado $POST de sexo, igualamos la variable a el valor
    if (isset($_POST["sexo"])) {
        $sexo = $_POST["sexo"];
    }

    $errorFoto = $_FILES["foto"]["name"] != "" && ($_FILES["foto"]["error"]  || !getimagesize($_FILES["foto"]["tmp_name"]) || $_FILES["foto"]["size"] > 500 * 1000);

    //lo asociamos en una sola variable
    $errores = $errorNombre || $errorUsuario || $errorContra || $errorDNI || $errorSexo || $errorFoto;
}

//si se pulsa y no hay errores, mostramos el resultado de lo recibido con sus valores correspondientes
if (isset($_POST["enviar"]) && !$errores) {

    require "vistas/vista_recogida.php"; //con require mandamos al archivo de la vista recogida

} else {

    require "vistas/vista_form.php";
}

function isValid($dniCompleto)
{
    if (strlen($_POST["dni"]) == 9) {
        $dni = substr($dniCompleto, 0, 8);
        $letra = strtoupper(substr($dniCompleto, -1));

        //si la letra es numerica, significa que no es una letra sino un numero(no hay letra)
        if ($letra >="A" && $letra <="Z") {
            $letraCorrespondiente = substr("TRWAGMYFPDXBNJZSQVHLCKEO", $dni % 23, 1);
            return $letra == $letraCorrespondiente; //determianmos si el dni es correcto
        } else {
            return false;
        }
    }
    return false;
}
