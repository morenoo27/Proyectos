<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 14</title>
</head>

<body>

    <table border="1">
        <tr>
            <th colspan="2">Estadios</th>
        </tr>
        <tr>
            <th>Equipo</th>
            <th>Estadio</th>
        </tr>

        <?php
        $estadios = array("Barcelona" => "Camp Nou", "Real Madrid" => "Santiago Bernabeu", "Valencia" => "Mestalla", "Real Sociedad" => "Anoeta");
        unset($estadios["Real Madrid"]);//para borrar 
        foreach ($estadios as $equipo => $estadio) {
            echo "<tr><td>$equipo</td><td>$estadio</td></tr>";
        }
        ?>
    </table>

</body>

</html>