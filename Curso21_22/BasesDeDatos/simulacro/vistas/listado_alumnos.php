<h4>Listado de los alumnos</h4>
<ol>
    <?php

    $consulta = "SELECT cod_alu, nombre FROM alumnos";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        
        if (mysqli_num_fields($resultado) == 0) {
            echo "<li>Tabla sin datos</li>";
        } else {
            while ($datos = mysqli_fetch_assoc($resultado)) {

                echo '<li><form action="index.php" method="post"><input type="hidden" name="idAlumno" value="' . $datos["cod_alu"] . '"><button type="submit" name="listarAlumno">' . $datos["nombre"] . '</button></form></li>';
            }
        }

        mysqli_free_result($resultado);
    } else {
        $fallo = mysqli_errno($conexion);
        $error = mysqli_error($conexion);
        echo "<span class='error'>Fallo en el acceso a datos. Error Nº: $fallo. $error</span>";
    }

    ?>
</ol>