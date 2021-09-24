<?php

$err_nombre = false;
$err_sex = false;

if (isset($_POST["enviar"])) {

    $err_nombre = $_POST["name"] == "";
    $err_sex = !isset($_POST["sex"]);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Mi primera página PHP</title>
</head>

<body>

    <h1>Esta es mi super página</h1>

    <form action="index.php" method="post">

        <label for="nombre">Nombre: </label>
        <input type="text" name="name" id="nombre">
        <?php
        if ($err_nombre) {
            echo "<label style='color:red;'>*Campo obligatorio*</label>";
        }
        ?>


        <br />

        <label for="LNacimiento">Nacido en : </label>
        <select name="nacimiento" id="LNacimiento">

            <option value="malaga" <?php if (isset($_POST["nacimiento"]) && ($_POST["nacimiento"] == "malaga")) echo "selected" ?>>Málaga</option>
            <option value="cadiz" <?php if (isset($_POST["nacimiento"]) && ($_POST["nacimiento"] == "cadiz")) echo "selected" ?>>Cádiz</option>
            <option value="sevilla" <?php if (isset($_POST["nacimiento"]) && ($_POST["nacimiento"] == "sevilla")) echo "selected" ?>>Sevilla</option>

        </select>

        <br />

        <label>Sexo: </label>
        <label for="hombre">Hombre</label>
        <input type="radio" name="sex" id="hombre" value="hombre">

        <label for="mujer"> Mujer </label>
        <input type="radio" name="sex" id="mujer" value="mujer">

        <?php
        if ($err_sex) {
            echo "<label style='color:red;'>*Campo obligatorio*</label>";
        }
        ?>

        <br />

        <label>Aficiones: </label>

        <label for="dep"> Deportes</label>
        <input type="checkbox" name="afic[]" id="dep" value="Deportes"
        <?php
            if (isset($_POST["afic"])) {
                for ($i=0; $i < count($_POST["afic"]); $i++) { 
                    if (($_POST["afic"][$i])=="Deportes") {
                        echo"checked";
                    }
                }
            }
            
        ?>>

        <label for="lec"> Lectura</label>
        <input type="checkbox" name="afic[]" id="lec" value="Lectura"
        <?php
            if (isset($_POST["afic"])) {
                for ($i=0; $i < count($_POST["afic"]); $i++) { 
                    if (($_POST["afic"][$i])=="Lectura") {
                        echo"checked";
                    }
                }
            }
            
        ?>>

        <label for="otro"> Otros</label>
        <input type="checkbox" name="afic[]" id="otro" value="Otros"
        <?php
            if (isset($_POST["afic"])) {
                for ($i=0; $i < count($_POST["afic"]); $i++) { 
                    if (($_POST["afic"][$i])=="Otros") {
                        echo"checked";
                    }
                }
            }
            
        ?>>

        <br />

        <label for="com">Comentarios: </label>
        <textarea name="coment" id="com" cols="30" rows="10">
            <?php if (isset($_POST["coment"])) echo $_POST["coment"] ?>
        </textarea>

        <br />

        <input type="submit" value="Enviar datos" name="enviar">

    </form>

</body>

</html>