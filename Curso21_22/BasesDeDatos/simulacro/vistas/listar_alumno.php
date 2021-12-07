<?php

$consulta = "SELECT * FROM alumnos WHERE cod_alu='" . $_POST["idAlumno"] . "'";
$resultado = mysqli_query($conexion, $consulta);
if ($resultado) {
    $datos = mysqli_fetch_assoc($resultado);
?>
    <h3>Detalles del usuario <?php echo $_POST["idAlumno"] ?></h3>

    <form action="index.php" method="post">
        <p>
            <b>Nombre:</b> <br>
            <?php echo $datos["nombre"] ?>
        </p>
        <p>
            <b>Telefono:</b> <br>
            <?php echo $datos["telefono"] ?>
        </p>
        <p>
            <b>Código postal:</b> <br>
            <?php echo $datos["cp"] ?>
        </p>
        <p>
            <b>Notas:</b> <br>
        <table>
            <tr>
                <th class="conBorde">Asignatura</th>
                <th class="conBorde">Nota</th>
                <th></th>
            </tr>

            <?php
            $consulta = "SELECT notas.nota, asignaturas.denominacion, asignaturas.cod_asig FROM notas JOIN asignaturas ON notas.cod_asig=asignaturas.cod_asig WHERE cod_alu='" . $_POST["idAlumno"] . "'";
            $resultado = mysqli_query($conexion, $consulta);
            if ($resultado) {
                if (mysqli_num_rows($resultado) == 0) {
                    echo "<tr><td class='conBorde' colspan='2'>Alumno no matriculado en ninguna asignatura</td><td></td></tr>";
                } else {
                    $asignatura = 1;
                    while ($datos = mysqli_fetch_assoc($resultado)) {
                        echo '<tr><form action="index.php" method="post">';
                        echo "<td class='conBorde'>" . $datos["denominacion"] . "</td>";
                        echo "<td class='conBorde'>" . montarSelect($datos["nota"], $asignatura) . "</td>";
                        echo '<td><input type="hidden" name="numAsig" value="' . $asignatura . '"><input type="hidden" name="idAlumno" value="' . $_POST["idAlumno"] . '"><input type="hidden" name="idAsig" value="' . $datos["cod_asig"] . '"><button type="submit" name="cambiarNota">Cambiar nota</button></td></form>';
                        echo "</tr>";
                        $asignatura++;
                    }
                }
            } else {
                $fallo = mysqli_errno($conexion);
                $error = mysqli_error($conexion);
                echo "<tr><td colspan='2'><span class='error'>Fallo en en acceso a las matriculas del alumno. Error Nº: $fallo. $error</span></td><td></td></tr>";
            }

            ?>


        </table>
        </p>

        <button type="submit">Atrás</button>
    </form>
<?php
    mysqli_free_result($resultado);
} else {
    $fallo = mysqli_errno($conexion);
    $error = mysqli_error($conexion);
    echo "<span class='error'>fallo en el acceso a los datos del alumno. Error Nº: $fallo. $error</span>";
}
?>