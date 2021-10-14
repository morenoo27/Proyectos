<?php

//para borrar todos los campos

/* Realmente lo que hacemos es quitar que sea un tipo reset, 
que sea submint y si se pulsa (isset) pues recargamos la 
pagina redirigiendola a la misma*/
if (isset($_POST["borrar"])){
    header ("Location:index.php");
    exit;
}

/*Primero vemos que se haya pulsado el bootn de enviar*/
if (isset($_POST["enviar"])) {



    //comprobamos los errores
    $err_nombre = $_POST["nombre"] == "";
    $err_apellidos = $_POST["apellidos"] == "";
    $err_pass = $_POST["pass"] == "";
    $err_dni = $_POST["dni"] == "";
    $err_comentarios = $_POST["cometarios"] == "";
    $err_sexo = !isset($_POST["sexo"]); //al ser un boton, con solamente preguntar si esta instanciado se sabe si se ha pulsado o no

    //lo asociamos en una sola variable
    $errores = ($err_nombre | $err_apellidos | $err_pass | $err_dni | $err_sexo | $err_comentarios);
}

//si se pulsa y no hay errores, mostramos el resultado de lo recibido con sus valores correspondientes
if (isset($_POST["enviar"]) && !$errores) {

    require "vistas/vista_recogida.php";//con require mandamos al archivo de la vista recogida

} else {

    require "vistas/vista_form.php";
}

?>