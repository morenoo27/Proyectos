<?php

require "src/cte_funciones.php";

//INSTANCIA DE SESION
session_name("simulacro");
session_start();

//CONTROL ERRORRES FORMULARIO
if (isset($_POST["inicio_sesion"])) {

    //COMPROBAMOS ERRORES
    $errorusuario = $_POST["usuario"] == "";
    $errorClave = $_POST["pass"] == "";

    $errores = $errorusuario || $errorClave;


    //SIGUIENTE PASO(SI NO NADA VACIO)
    if (!$errores) {

        //INICIO CONEXION CON BASE DE DATOS
        $conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);

        //CONTROL ERROR CONEXION BASE DE DATOS
        if (!$conexion) {

            $numErr = mysqli_connect_errno();
            $error = mysqli_connect_error();
            die(error_page("Fallo en la conexion", "Fallo al intentar conectar con el servidor de base de datos. Error Nº $numErr: $error"));
        }

        //CONSULTA PARA INICIO DE SESION
        $consulta = "SELECT usuario,clave FROM clientes WHERE usuario='" . $_POST["usuario"] . "'" . " AND clave='" . md5($_POST["pass"]) . "'";
        $resultado = mysqli_query($conexion, $consulta);

        //CONTROL FALLO EN QUERY
        if (!$resultado) {

            $nunError = mysqli_errno($conexion);
            $error = mysqli_error($conexion);

            mysqli_close($conexion);

            die(error_page("Error en la busqueda", "Error al buscar en la base de datos. Error Nº $nunError: $error"));
        }

        //SELECCION DE USUARIO
        if (mysqli_num_rows($resultado) > 0) {

            $datos = mysqli_fetch_assoc($resultado);

            $clave = $datos["clave"];
            $usuario = $datos["usuario"];

            mysqli_free_result($resultado);

            //resultado
            $existe = true;
        } else {

            //resultado
            $existe = false;
        }


        //CIERRE DE CONEXION
        mysqli_close($conexion);

        //SIGUIENTE PASO, INICIO DE SESION Y SALTO DE PAGINA
        if ($existe) {

            $_SESSION["clave"] = $clave;
            $_SESSION["usuario"] = $usuario;
            $_SESSION["ultima_conexion"] = time();

            header("Location:vistas/clientes/cliente.php");
            exit;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Simulacro Examen</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <h1>Simulacro examen Sesiones</h1>

    <form action="index.php" method="post">
        <p>
            <label for="usuario">Usuario: </label>
            <input type="text" name="usuario" id="usuario">
            <?php
            if (isset($_POST["inicio_sesion"]) && $errorusuario) {
                echo "<span class='error'>*CAMPO OBLIGATORIO*</span>";
            }
            ?>
        </p>
        <p>
            <label for="pass">Contraseña: </label>
            <input type="password" name="pass" id="pass">
            <?php
            if (isset($_POST["inicio_sesion"]) && $errorClave) {
                echo "<span class='error'>*CAMPO OBLIGATORIO*</span>";
            }
            ?>
        </p>
        <p>
            <?php
            if (isset($_POST["inicio_sesion"]) && isset($errorInicio) && $errorInicio) {
                echo "<span class='error'>* Usuario y/o contraseña incorrectos *</span><br>";
            }

            if (isset($_SESSION["restringido"])) {
                echo "<span class='error'>* " . $_SESSION['restringido'] . " *</span><br>";

                //una vez mostrado el mensaje, eliminamos la variable y listo
                unset($_SESSION["restringido"]);
            }
            ?>
            <button type="submit" formaction="vistas/registro_usuario.php">¿Aun no te has registrado?</button> -
            <button type="submit" name="inicio_sesion">Iniciar sesion</button>
        </p>
    </form>
</body>

</html>