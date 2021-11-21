<?php
require "src/cte_funciones.php";


@$conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
if (!$conexion) {
    die(error_page("PRACTICA 8", "Fallo en la conexion con el servido. Error nº:" . mysqli_connect_errno() . " : " . mysqli_connect_error()));
}

/* CREACION DE NUEVO USUARIO */
if (isset($_POST['insertarUsuario'])) {

    $errorNombre = $_POST['nombreUsuarioCREAR'] == '';
    $errorUsuario = $_POST['usuarioCREAR'] == '' || repetido($conexion, "usuarios", "usuario", $_POST['usuarioCREAR']);
    if (is_array($errorUsuario)) {
        mysqli_close($conexion);
        die(error_page("Primer CRUD - Nuevo Usuario", "<h1>Nuevo Usuario</h1><p>" . $errorUsuario["error"] . "</p>"));
    }
    $errorPass = $_POST['contraseñaCREAR'] == '';
    $errorDNI = $_POST["dniCREAR"] == "" || strlen($_POST["dniCREAR"]) != 9 || !isValid($_POST["dniCREAR"]);
    $errorFoto = $_FILES["fimagenCREAR"]['name'] != '' && ($_FILES["fimagenCREAR"]["error"]  || !getimagesize($_FILES["fimagenCREAR"]["tmp_name"]) || $_FILES["fimagenCREAR"]["size"] > 500 * 1000);

    $errores = $errorNombre || $errorUsuario || $errorPass || $errorDNI || $errorFoto;

    if (!$errores) {

        insertarUsuario($conexion, $_POST['usuarioCREAR'], $_POST['nombreUsuarioCREAR'], $_POST['contraseñaCREAR'], $_POST['sexoCREAR'],  $_POST["dniCREAR"]);

        //control del nombre de la foto de perfil, si tiene
        if ($_FILES["fimagenCREAR"]['name'] == '') {
            $_FILES["fimagenCREAR"]['name'] = 'no_imagen.jpg';
        } else {
            $id = mysqli_insert_id($conexion) + 1;

            $arrFoto = explode(".", $_FILES["foto"]["name"]);

            $extension = "";
            if ($extension != $_FILES["foto"]["name"]) {
                $extension = "." . end($arrFoto);
            }

            $directorio = $id. $extension;

            move_uploaded_file($_FILES["fimagenCREAR"]["tmp_name"], "imagenes/img$directorio");

            $_FILES["fimagenCREAR"]['name'] = $directorio;
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

        img {
            width: 30%;
        }
    </style>
</head>

<body>
    <h1>PRACTICA 8</h1>
    <?php

    //INSERTAR NUEVO USUARIO
    if (isset($_POST['crearUsuario']) || isset($_POST['insertarUsuario'])) {
        /* MOSTRAMOS UN FORMULARIO NOCMAL Y CORRIENTE COMO HEMOS HEHCO SIEMPRE, CONTROLANDO LOS FALLOS Y DEMAS */
    ?>

        <form action="index.php" method="post" enctype="multipart/form-data">
            <p>
                <label for="nombreUsuarioCREAR">Nombre de usuario:</label> <br>
                <input type="text" name="nombreUsuarioCREAR" id="nombreUsuarioCREAR" value="<?php if (isset($_POST['nombreUsuarioCREAR'])) echo $_POST['nombreUsuarioCREAR'] ?>">
                <?php
                /*ERRORES*/
                if (isset($_POST['insertarUsuario']) && $errorNombre) {
                    echo "<span class='error'>*Campo obligatorio*</span>";
                }
                ?>
            </p>

            <p>
                <label for="usuarioCrear">Usaurio:</label> <br>
                <input type="text" name="usuarioCREAR" id="usuarioCrear" value="<?php if (isset($_POST['usuarioCREAR'])) echo $_POST['usuarioCREAR'] ?>">
                <?php
                /*ERRORES*/
                if (isset($_POST['insertarUsuario']) && $errorUsuario) {
                    if ($_POST['usuarioCREAR'] == '') {
                        echo "<span class='error'>*Campo obligatorio*</span>";
                    } else {
                        echo "<span class='error'>*Usuario en uso*</span>";
                    }
                }
                ?>
            </p>

            <p>
                <label for="contraseñaCREAR">Contraseña:</label> <br>
                <input type="password" name="contraseñaCREAR" id="contraseñaCREAR">
                <?php
                /*ERRORES*/
                if (isset($_POST['insertarUsuario']) && $errorPass) {
                    echo "<span class='error'>*Campo obligatorio*</span>";
                }
                ?>
            </p>

            <p>
                <label for="dniCREAR">DNI:</label> <br>
                <input type="text" name="dniCREAR" id="dniCREAR" value="<?php if (isset($_POST['dniCREAR'])) echo $_POST['dniCREAR'] ?>">
                <?php
                /*ERRORES*/
                if (isset($_POST['insertarUsuario']) && $errorDNI) {
                    if ($_POST['dniCREAR'] == '') {
                        echo "<span class='error'>*Campo obligatorio*</span>";
                    } else {
                        if (strlen($_POST["dniCREAR"]) != 9) {
                            echo "<span class='error'>*El DNI debe tener 8 caracteres numericos y una letra en mayusculas*</span>";
                        } else {
                            echo "<span class='error'>*DNI no valido*</span>";
                        }
                    }
                }
                ?>
            </p>

            <p>
                <label for="hombreCREAR">Sexo: </label>
                <input type="radio" name="sexoCREAR" id="hombreCREAR" value="hombre" checked>
                <label for="hombreCREAR"> Hombre </label>
                <input type="radio" name="sexoCREAR" id="mujerCREAR" value="mujer">
                <label for="mujerCREAR"> Mujer </label>
            </p>

            <p>
                <label for="fimagenCREAR">Seleccione un archivo como foto de perfil:</label>
                <input type="file" name="fimagenCREAR" accept="image" id="fimagenCREAR">
                <?php
                /*ERRORES*/
                if (isset($_POST['insertarUsuario']) && $errorFoto) {
                    if ($_FILES["fimagenCREAR"]["error"]) {
                        echo "<span class='error'>*Ha ocurrido un error en la subida del archivo*</span>";
                    } else {
                        if (!getimagesize($_FILES["fimagenCREAR"]["tmp_name"])) {
                            echo "<span class='error'>*El archivo subido no es una imagen*</span>";
                        } else {
                            echo "<span class='error'>*El archivo es superior a lo permitido*</span>";
                        }
                    }
                }
                ?>
            </p>

            <p>
                <button type="submit">Voler</button> <button type="submit" name="insertarUsuario">Continuar</button>
            </p>
        </form>
    <?php

    }


    ?>
    <h3>Listado de usuarios</h3>
    <?php if (isset($_POST['insertado'])) {
        echo "<p>Usuario insertado con exito</p>";
    } ?>
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
                echo "<td><img src='imagenes/" . $datos["foto"] . "' alt='foto de perfil'></td>";
                echo '<td><form action="index.php" method="post"><input type="hidden" name="idListar" value="' . $datos["id_usuario"] . '"><button type="submit" class="sin_boton" name="listarUsaurio">' . $datos["nombre"] . '</button></form></td>';
                echo '<td><form action="index.php" method="post"><input type="hidden" name="idEditarBorrar" value="' . $datos["id_usuario"] . '"><button type="submit" class="sin_boton" name="editarUsuario">Editar</button> - <button type="submit" class="sin_boton name="borarUsuario">Borrar</button></td>';
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