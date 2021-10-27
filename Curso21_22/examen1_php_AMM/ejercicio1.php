<?php
function miStrLen($array)
{
    $contador = 0;
    for ($i=0; $i < count($array["texto"]); $i++) { 
        $contador++;
    }

    return $contador;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>
<body>
    <form action="ejercicio1.php" method="post">
        <p>
            <label for="texto">Introduce un texto:</label> <br>
            <input type="text" name="texto" id="texto" value="<?php if (isset($_POST["contar"])) echo $_POST["texto"];?>">
        </p>
        <p>
            <button type="submit" name="contar">Contar caracteres</button>
        </p>
    </form>

    <?php
        if (isset($_POST["contar"])) {
            
            
        }
    ?>
</body>
</html>