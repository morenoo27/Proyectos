<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoria Fechas</title>
</head>

<body>
    <?php
    $timepo = time();//tiempo que ha pasado hasta ahora desde que se creo php
    echo "$timepo<br>";
    echo date("d/m/Y", time())."<br>";//mostrar fecha de este timepo
    echo date("d/F/Y h:i:s", mktime(21, 40, 0, 3, 27, 2000));//
    
    ?>
</body>

</html>