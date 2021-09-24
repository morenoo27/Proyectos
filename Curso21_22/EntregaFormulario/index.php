<?php

/*Primero vemos que se haya pulsado el boton de enviar*/
if (isset($_POST["enviar"])) {

    //miramos los errores
    $errores = (($_POST["name"] == "") | (!isset($_POST["sex"])));
}

//si se pulsa y no hay errores, mostramos el resultado de lo recibido con sus valores correspondientes
if (isset($_POST["enviar"]) && !$errores) {

    require "vistas/datos.php"; //accedemos al archivo de la vista recogida

} else {

    require "vistas/formulario.php"; //nos vamos al formularios
}

//HOLA BUENAS

//segundo intento
