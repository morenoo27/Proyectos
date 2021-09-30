<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>

    <?php
    $palabra1 = "hola";
    $palabra2 = "caracola";

    $long1 = strlen($palabra1);
    $long2 = strlen($palabra2);

    $rima = ["no comparado", "no riman", "riman un poco", "riman"];
    $respuesta = $rima[0];

    for ($i = 1; $i <= 3; $i++) {

        if ($palabra1[$long1 - $i] == $palabra2[$long2 - $i]) {
            $respuesta = $rima[$i];
        } else {
            break;
        }
    }

    echo $respuesta;
    ?>
</body>

</html>