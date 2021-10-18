<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejercicio</title>
</head>

<body>
    <?php
    
    function escribirNumerosMod(array $numeros, string $modo)
    {
        switch ($modo) {
            case 'sobreescribir':
                $modo = "w";
                break;
            case 'ampliar':
                $modo = "a";
                break;
            default:
                die("<p>Modo erroneo</p>");
        }

        @$DescriptorFichero = fopen("datosEjercicio.txt", $modo); //DescriptorFichero = puntero
        if (!$DescriptorFichero) {
            die("<p>No se encunetra el archivo</p>");
        }

        foreach ($numeros as $numero) {
            fwrite($DescriptorFichero, $numero . PHP_EOL);
        }

        fclose($DescriptorFichero);
    }

    function leerContenidoFichero(string $directorio)
    {
        @$DescriptorFichero = fopen($directorio, "r");

        if (!$DescriptorFichero) {
            die("archivo no encontrado");
        }

        echo nl2br(file_get_contents($directorio));

        fclose($DescriptorFichero);
    }

    escribirNumerosMod([2, 8, 14], "sobreescribir");
    leerContenidoFichero("datosEjercicio.txt");
    echo "<br>";
    escribirNumerosMod([3, 11, 16], "ampliar");
    leerContenidoFichero("datosEjercicio.txt");
    echo "<br>";
    escribirNumerosMod([4, 99, 12], "sobreescribir");
    leerContenidoFichero("datosEjercicio.txt");
    ?>

</body>

</html>