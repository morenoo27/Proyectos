<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 11</title>
</head>
<body>
    <p>
        <?php 
            $animales = array("Lagartija","Araña","Perro","Gato","Ratón");
            $numeros = array("12","34","45","52","12");
            $arboles = array("Sauce","Pino","Naranjo","Chopo","Perro","34");

            $papito = array_merge($animales,$arboles,$numeros);
            print_r($papito)
        ?>
    </p>
</body>
</html>