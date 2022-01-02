<?php

//CONSULTA

$consulta = "SELECT * FROM usuarios WHERE lector='" . $_SESSION["usuario"] . "'" . " AND clave='" . md5($_SESSION["clave"]) . "'";
$resultado = mysqli_query($conexion, $consulta);

//CONTROL FALLO EN QUERY
if (!$resultado) {
    $numerr = mysqli_errno($conexion);
    $err = mysqli_error($conexion);
    echo "<p>Error en la consulta a la base de datos. Error Nº:$numerr: $err</p>";
    mysqli_close($conexion);

    session_destroy();
} else {

    //encuentra
    if (mysqli_num_rows($resultado) == 0) {
        //si no encuentra significa que no hay usaurios con esas credenciales

        //LIBERACION DE MEMORIA
        mysqli_free_result($resultado);

        $_SESSION["restringido"] = "<span class='error'>*Usuario baneado*</span>";

        unset($_SESSION["usuario"]);

        header("Location:index.php");
        exit;
    }

?>


    <p>
        <span>Bienvenido <?php echo $_SESSION["usuario"] ?></span>
    <form action="index.php" method="post">
        <button type="submit" name="accion">Accion</button>
        <button type="submit" name="cerrarSesion">Salir</button>
    </form>
    </p>

<?php } ?>