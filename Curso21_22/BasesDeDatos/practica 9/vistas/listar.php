<?php

$id = $_POST['idListar'];

$consulta = "SELECT * FROM peliculas WHERE idPelicula='$id'";
$resultado = mysqli_query($conexion, $consulta);

if ($resultado) {

    $pelicula = mysqli_fetch_assoc($resultado);
?>
    <table>
        <tr>
            <td>
                <p>
                    <b>Título:</b> <?php echo $pelicula["titulo"] ?>
                </p>
                <p>
                    <b>Director:</b> <?php echo $pelicula["director"] ?>
                </p>
                <p>
                    <b>Sinopsis:</b> <?php echo $pelicula["sinopsis"] ?>
                </p>
                <p>
                    <b>Temática:</b> <?php echo $pelicula["tematica"] ?>
                </p>
            </td>
            <td>
                <img src="<?php echo "imagenes/" . $pelicula["caratula"] ?>" alt="Caratula de la pelicula">
            </td>
        </tr>
    </table>
<?php
} else {
    $numError = mysqli_errno($conexion);
    $error = mysqli_error($conexion);
    echo "<p class='error'>Fallo En el acceso a los datos. Nº $numError: $error</p>";
}
?>