<?php

function estaEnUso($conexion, $nombreABuscar)
{
    $consulta = "select * from usuarios where usuario='" . $nombreABuscar . "'";
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

require "src/config.php";

@$conexion = mysqli_connect(SERVIDOR_BD, NOMBRE_USUARIO, "hola", NOMBRE_BD);
if (!$conexion) {

    $errorConexionBD = true;
} else {
    $errorConexionBD = false;

    mysqli_set_charset($conexion, "utf8");
}

if (isset($_POST["registrarse"])) {

    //comprobamos errores
    $errorNombre = $_POST["nombreCompleto"] == "";
    $errorUsuario = $_POST["nombreUsuario"] == "";

    // si no esta vacio, comprobamos si esta en uso
    // si esta vacio no hace falta mirar que dicho campo este repetido en la base de datos
    if (!$errorUsuario) {
        $errorUsuario = estaEnUso($conexion, $_POST["nombreUsuario"]);

        if (is_array($errorUsuario)) {
            //hubo un error en la consulta
            $errorConexionUsuario = true;
        } else {
            $errorConexionUsuario = false;
        }
    }

    $errorPass = $_POST["password"] == "";
    $errorEmail = $_POST["email"] == "" || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);

    $errores = $errorNombre || $errorUsuario || $errorPass || $errorEmail;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>

    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <?php
    if ($errorConexionBD) {
        echo "<span class='error'>*Imposible conectar. Error número: " . mysqli_connect_errno() .
            " : " . mysqli_connect_error() . "*</span>";
    }
    ?>
    <form action="usuario_nuevo.php" method="post">
        <p>
            <label for="nombre">Nombre:</label> <br>
            <input type="text" name="nombreCompleto" id="nombre" value="<?php if (isset($_POST["nombreCompleto"])) echo $_POST["nombreCompleto"] ?>">
            <?php
            if (isset($_POST["registrarse"]) && $errorNombre) {
                echo "<span class='error'>*Campo obligatorio*</span>";
            }
            ?>

        </p>
        <p>
            <label for="usuario">Nombre de usuario:</label> <br>
            <input type="text" name="nombreUsuario" id="usuario" value="<?php if (isset($_POST["nombreUsuario"])) echo $_POST["nombreUsuario"] ?>">
            <?php
            if (isset($_POST["registrarse"])) {
                //miramos si tiene relacion con un error en la conexion
                if (!$errorConexionUsuario) {
                    //no tiene que ver con la conexion
                    if ($errorUsuario) {
                        if ($_POST["nombreUsuario"] == "") {
                            echo "<span class='error'>*Campo obligatorio*</span>";
                        } else {
                            echo "<span class='error'>*Usuario en uso*</span>";
                        }
                    }
                } else {
                    echo "<span class='error'>*Fallo en la conexion a la base de datos para registrar dicho ususario*</span>";
                }
            }
            ?>
        </p>
        <p>
            <label for="pass">Contraseña:</label> <br>
            <input type="password" name="password" id="pass">
            <?php
            if (isset($_POST["registrarse"]) && $errorPass) {
                echo "<span class='error'>*Campo obligatorio*</span>";
            }
            ?>
        </p>
        <p>
            <label for="email">Email:</label> <br>
            <input type="text" name="email" id="email" value="<?php if (isset($_POST["email"])) echo $_POST["email"] ?>">
            <?php
            if (isset($_POST["registrarse"]) && $errorEmail) {
                if ($_POST["email"] == "") {
                    echo "<span class='error'>*Campo obligatorio*</span>";
                } else {
                    echo "<span class='error'>*Emain no valido*</span>";
                }
            }
            ?>
        </p>

        <?php 
            
        ?>

        <button type="submit" name="registrarse">Continuar</button>
        <button type="submit" formaction="index.php">Volver</button>
    </form>
    <?php
    if (!$errores) {
        //inserto y vuelvo a index.php


    }
    ?>
</body>

</html>