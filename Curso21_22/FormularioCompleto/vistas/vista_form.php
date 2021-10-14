<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rellena tu CV</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <h1>Rellena tu CV</h1>

    <form action="index.php" method="post" enctype="multipart/form-data">

        <label for="name">Nombre:</label><br>
        <input type="text" name="nombre" id="name" placeholder="Nombre..." <?php if (isset($_POST["enviar"]) && !$errorNombre) echo "value='" . $_POST["nombre"] . "'"; ?>>
        <?php if ($errorNombre) {
            echo "<label class='error'>*Campo obligatorio*</label>";
        } ?>

        <br><br>

        <label for="user">Usario:</label><br>
        <input type="text" name="usuario" id="user" placeholder="Usuario..." <?php if (isset($_POST["enviar"]) && !$errorUsuario) echo "value='" . $_POST["usuario"] . "'"; ?>>
        <?php if ($errorUsuario) {
            echo "<label class='error'>*Campo obligatorio*</label>";
        } ?>

        <br><br>

        <label for="pass">Contraseña:</label><br>
        <input type="password" name="contra" id="pass" placeholder="Contraseña...">
        <?php if ($errorContra) {
            echo "<label class='error'>*Campo obligatorio*</label>";
        } ?>

        <br><br>

        <label for="nif">DNI:</label><br>
        <input type="text" name="dni" id="nif" placeholder="DNI: 11223344Z" <?php if (isset($_POST["enviar"])) echo "value='" . $_POST["dni"] . "'"; ?>>
        <?php if ($errorDNI) {
            switch ($_POST["dni"]) {
                case "":
                    echo "<label class='error'>*Campo obligatorio*</label>";
                    break;
                case strlen($_POST["dni"]) != 9:
                    echo "<label class='error'>*DNI incompleto*</label>";
                    break;
                case !isValid($_POST["dni"]):
                    if ($letra >= "A" && $letra <= "Z") { //si esta comprendido esntre estos caracteres, la letra no es la correspondiente
                        echo "<label class='error'>*DNI no valido*</label>";
                    } else { //sino esque lo que se ha enviado no esta bien escrito
                        echo "<label class='error'>*El DNI debe estar compuesto por 8 numeros seguidos de una letra*</label>";
                    }


                    break;
                default:
                    break;
            }
        }
        ?>

        <br><br>

        <label>Sexo:</label>
        <?php if ($errorSexo) {
            echo "<label class='error'>*Campo obligatorio*</label>";
        } ?>
        <br>
        <input type="radio" name="sexo" id="hombre" value="Hombre" <?php if (isset($_POST["enviar"]) && $sexo == "Hombre") echo "checked"; ?>>
        <label for="hombre">Hombre</label><br>
        <input type="radio" name="sexo" id="mujer" value="Mujer" <?php if (isset($_POST["enviar"]) && $sexo == "Mujer") echo "checked"; ?>>
        <label for="mujer">Mujer</label>

        <br><br>

        <label for="foto">Incluir mi foto (Archivo de tipo imagen Máx: 500KB):</label>
        <input type="file" name="foto" id="foto">
        <?php
        if (isset($_POST["enviar"]) && $errorFoto) {
            echo "<label class='error'>*";
            switch ($_FILES["foto"]) {
                case $_FILES["foto"]["error"]:
                    echo "Error en la subida de la imagen";
                    break;
                case !getimagesize($_FILES["foto"]["tmp_name"]):
                    echo "El archivo no es una imagen";
                    break;
                default:
                    echo "Archivo superior al peso permitido";
                    break;
            }
            echo "*</label>";
        }
        ?>

        <br><br>

        <input type="checkbox" name="sus" id="suscripcion" <?php if (isset($_POST["sus"])) echo "checked" ?>>
        <label for="suscripcion">Suscribirme al boletin de novedades</label>

        <br><br>

        <input type="submit" name="enviar" value="Guardar cambios" />
        <input type="submit" name="borrar" value="Borrar cambios" />
    </form>
</body>

</html>