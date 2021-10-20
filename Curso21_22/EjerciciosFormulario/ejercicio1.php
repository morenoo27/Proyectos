<?php
if (isset($_GET["enviar"])) {
    $errores = $_GET["name"] == "" || $_GET["surname"] == "";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejrcicio1</title>
</head>

<body>
    <form action="ejercicio1.php" method="get">
        <label for="nombre">Nombre:</label>
        <input type="text" name="name" id="nombre">
        <?php if (isset($_GET["enviar"]) && $_GET["name"] == "") {
            echo "<label style='color:red;'>*Campo obligatorio*</label>";
        } ?>
        <br><br>

        <label for="ape">Apellidos</label>
        <input type="text" name="surname" id="ape">
        <?php if (isset($_GET["enviar"]) && $_GET["surname"] == "") {
            echo "<label style='color:red;'>*Campo obligatorio*</label>";
        } ?>
        <br><br>

        <input type="submit" value="Enviar datos" name="enviar">
    </form>

    <?php if (isset($_GET["enviar"]) && !$errores) echo $_GET["surname"] . ", " . $_GET["name"]; ?>
</body>

</html>