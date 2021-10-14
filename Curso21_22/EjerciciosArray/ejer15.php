<!DOCTYPE html>
<html>
    <head>
        <title>Ejercicio15</title>
        <meta charset="UTF-8"/>
    </head>
    <body>
        <h1>Ordenando de menor a mayor</h1>
        <?php
            //MÉTODO DE ORDENACIÓN DE BURBUJA
            //SE HARÍA CON SORT QUE YA ESTÁ PERO LO HECHO 
            //ASÍ PARA ENTENDER ESTE MÉTODO DE ORDENACIÓN
            $numeros = array(3, 2, 8, 123, 5, 1);
            $ordenados;

            for($i = 0; $i < count($numeros)-1; $i++){

                $cambios = true;

                for($j = 0; $j < count($numeros)-$i-1; $j++){

                    if($numeros[$j] > $numeros[$j+1]){

                        $temp = $numeros[$j];
                        $numeros[$j] = $numeros[$j+1];
                        $numeros[$j+1] = $temp;

                        $cambios = false;
                    }
                }

                if($cambios){

                    break;
                }
            }
        ?>
        <table border="1">
            <?php
                foreach($numeros as $ind => $val){

                    echo "<tr><td>".$val."</td></tr>";
                }
            ?>
        </table>
    </body>
</html>