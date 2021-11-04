<?php

function estaEnUso($conexion, $nombreABuscar)
{
    $consulta = "select * from usuarios where usuario='" . $nombreABuscar . "'";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        //miramos
    } else {
        # code...
    }
}

@$conexion = mysqli_connect(SERVIDOR_BD, NOMBRE_USUARIO, CLAVE, NOMBRE_BD);
if (!$conexion) {

    die("Imposible conectar. Error número: " . mysqli_connect_errno() .
        " : " . mysqli_connect_error());
}

mysqli_set_charset($conexion, "utf8");


if (isset($_POST["registrarse"])) {

    //comprobamos errores
    $errorNombre = $_POST["nombreCompleto"] == "";
    $errorUsuario = $_POST["nombreUsuario"] == "" || estaEnUso($conexion, $_POST["nombreUsuario"]);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
</head>

<body>
    <form action="usuario_nuevo.php" method="post">
        <p>
            <label for="nombre">Nombre:</label> <br>
            <input type="text" name="nombreCompleto" id="nombre">
        </p>
        <p>
            <label for="usuario">Nombre de usuario:</label> <br>
            <input type="text" name="nombreUsuario" id="usuario">
        </p>
        <p>
            <label for="pass">Contraseña:</label> <br>
            <input type="password" name="password" id="pass">
        </p>
        <p>
            <label for="email">Email:</label> <br>
            <input type="text" name="email" id="email">
        </p>

        <button type="submit" name="registrarse">Continuar</button>
        <button type="submit" formaction="index.php">Volver</button>
    </form>
</body>

</html>