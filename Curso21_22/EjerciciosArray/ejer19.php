<!DOCTYPE html>
<html>

<head>
    <title>Ejercicio19</title>
    <meta charset="UTF-8" />
</head>

<body>
    <h1>Amigos</h1>
    <?php
    $amigos = array(

        "Madrid"=>array(array("nombre"=>"Pedro", "edad"=>32, "telefono"=>919999999),
                        array("nombre"=>"Juan", "edad"=>28, "telefono"=>919999333)),
        "Barcelona"=>array(array("nombre"=>"Susana", "edad"=>34, "telefono"=>930000000),
                            array("nombre"=>"Maria", "edad"=>29, "telefono"=>919991111)),
        "Toledo"=>array(array("nombre"=>"Manuel", "edad"=>21, "telefono"=>919999966),
                        array("nombre"=>"Laura", "edad"=>20, "telefono"=>919999955))                
    );
    echo "<ul>";
    foreach($amigos as $ciudad => $contenido){

        echo "<li>".$ciudad."</li>";

        foreach($contenido as $persona => $datos){
            
            echo "<ol>";
            foreach($datos as $i => $valor){

                echo "<li>".$i.": ".$valor."</li>";
            }
            echo "</ol>";
        }
    }
    echo "</ul>";
    ?>
</body>

</html>