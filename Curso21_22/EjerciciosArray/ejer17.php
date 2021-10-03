<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 16</title>
</head>

<body>
    <ul>
        <?php
        $familias = ["Los Simpson" => array("padre" => "Homer", "madre" => "Marge", "hijos" => array("Bart", "Lisa", "Maggie")), "Los Griffin" => array("padre" => "Peter", "madre" => "Lois", "hijos" => array("Chris", "Meg", "Stewie"))];

        foreach ($familias as $nombreFamilia => $familia) {

            echo "<li>$nombreFamilia</li><ul>";

            foreach ($familia as $nivel => $integrante) {

                if ($nivel == "hijos") {
                    echo "<li>$nivel:<ol>";
                    foreach($integrante as $nombre){
                        echo "<li>$nombre</li>";
                    }
                    echo "</ol></li>";
                } else {
                    echo "<li>$nivel: $integrante</li>";
                }
            }
            echo "</ul>";
        }
        ?>
    </ul>
</body>

</html>