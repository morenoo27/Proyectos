<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 12</title>
</head>

<body>
    <p>
        <?php
        $animales = array("Lagartija", "Araña", "Perro", "Gato", "Ratón");
        $numeros = array("12", "34", "45", "52", "12");
        $arboles = array("Sauce", "Pino", "Naranjo", "Chopo", "Perro", "34");

        foreach ($animales as $animal) {
            $array[] = $animal;
        }
        foreach ($numeros as $numero) {
            $array[] = $numero;
        }
        foreach ($arboles as $cosa) {
            $array[] = $cosa;
        }
        print_r($array)
        ?>
    </p>
</body>

</html>