<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEORIA</title>
</head>

<body>
    <?php
    /*_________________________________________________________________________________________________________________________________________*/


    @$punteroFichero = !fopen("prueba.txt", "r"); //modo de apertura => r - read(leer) | w - write(escribir) | a - append(añadir)

    if ($punteroFichero) {
        die("<p>Archivo no encontrado</p>");
    }

    // $linea = fgets($punteroFichero);//obtiene la linea 1 (cuando se ejecuta el flujo avanza a la siguiente linea)

    /*LEER TODO EL ARCHIVO*/
    while ($linea = fgets($punteroFichero)) {
        echo "<p>$linea</p>";
    }

    fseek($punteroFichero, 0); //establece el flujo en la linea X

    //manera profesional
    /**esta foram lo que da s un error ya que salta a una linea que no existe */
    while (!feof($punteroFichero)) {
        $linea = fgets($punteroFichero);
        echo "<p>$linea</p>";
    }
    //esta, mientras no sea le final del programa escribe el flujo del punteroFichero que tenemos en cuestion+

    fclose($punteroFichero); //cierra el punteroFichero
    /*_________________________________________________________________________________________________________________________________________*/

    /* ANTES DE ESCRIBIR ("w") DEBEMOS DAR PERMISOS DE ADMINISTRADOR A LA CARPETA */
    @$punteroFichero = !fopen("prueba1.txt", "w"); //modo de apertura => r - read(leer) | w - write(escribir) | a - append(añadir)
    /* AL ABRIR EL ARCHIVO, se pone en modo escritura PERO ELIMINA TODO EL CONTENIDO QUE TENIA EN EL TEXTO */

    if ($punteroFichero) {
        die("<p>Archivo no encontrado</p>");
    }

    fputs($punteroFichero, "Una linea" . PHP_EOL); //escribe Y CONCATENA en el final del punteroFichero "$punteroFichero" el texto correspondiente
    fputs($punteroFichero, "Otra linea" . PHP_EOL); //PHP_EOL funciona como fin de linea

    fclose($punteroFichero);

    /*_________________________________________________________________________________________________________________________________________*/

    @$punteroFichero = fopen("prueba1.txt", "a"); //modo de apertura => r - read(leer) | w - write(escribir) | a - append(añadir)
    /* AL ABRIR EL ARCHIVO, se pone en modo escritura PERO NO ELIMINA TODO EL CONTENIDO QUE TENIA EN EL TEXTO */

    if ($punteroFichero) {
        die("<p>Archivo no encontrado</p>");
    }

    fputs($punteroFichero, "Una linea1" . PHP_EOL); //escribe Y CONCATENA en el final del punteroFichero "$punteroFichero" el texto correspondiente
    fputs($punteroFichero, "Otra linea" . PHP_EOL); //PHP_EOL funciona como fin de linea

    fclose($punteroFichero);
    ?>
    <h2>Escribimos el fichero "prueba1.txt" del tiron</h2>
    <?php
    echo nl2br(file_get_contents("prueba1.txt"))
    //nl2br => reemplaza nl por br
    //file_get_contents obtiene todo el codigo (Y CODIGO FUENTE) de un directorio
    ?>
</body>

</html>