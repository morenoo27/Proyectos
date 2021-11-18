<?php
require "src/cte_funciones.php";


@$conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
if (!$conexion) {
    die(error_page("PRACTICA 8", "Fallo en la conexion con el servido. Error nº:" . mysqli_connect_errno() . " : " . mysqli_connect_error()));
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRACTICA 8</title>
    <style>
        td,
        th {
            text-align: center;
        }

        .sin_boton {
            background: transparent;
            border: none;
            color: blue;
            text-decoration: underline;
            cursor: pointer
        }
    </style>
</head>

<body>
    <h1>PRACTICA 8</h1>
    <h3>Listado de usuarios</h3>
    <table border="1">
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Usuario</th>
            <th>
                <form action="index.php" method="post"><button type="submit" class="sin_boton" name="crearUsuario">Usuario+</button></form>
            </th>
        </tr>
        <?php
        $consulta = "SELECT * FROM usuarios";
        $resultado = mysqli_query($conexion, $consulta);
        if ($resultado) {
            while ($datos = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>" . $datos["id_usuario"] . "</td>";
                echo "<td></td>";
                echo '<td><form action="index.php" method="post"><input type="hidden" name="idListar" value="' . $datos["id_usuario"] . '"><button type="submit" name="listarUsaurio">' . $datos["nombre"] . '</button></form></td>';
                echo '<td><form action="index.php" method="post"><input type="hidden" name="idEditarBorrar" value="' . $datos["id_usuario"] . '"><button type="submit" name="editarUsuario">Editar</button> - <button type="submit" name="borarUsuario">Borrar</button></td>';
                echo "<tr/>";
            }
        } else {
            $nErr = mysqli_errno($conexion);
            $err = mysqli_error($conexion);
            mysqli_close($conexion);
            die("<tr><td colspan='4' class='error'>Error en la consulta a la base de datos. Error nº:$nErr : $err</td></tr></table></body>");
        }
        ?>

    </table>
</body>

</html>