

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica Examen 3</title>
    <style>
        .enlinea{display:inline}
        .sin_boton{background-color: transparent;border:none;color:blue;text-decoration: underline;cursor:pointer}
    </style>
</head>
<body>
    <h1>Práctica Examen 3</h1>
    <div>Bienvenido <strong><?php echo $_SESSION["usuario"];?></strong> - 
        <form class="enlinea" method="post" action="clientes.php">
            <button class="sin_boton" type="submit" name="btnCerrarSesion">Salir</button>
        </form>
    </div>
    <?php
        if(isset($_SESSION["accion"]))
        {
            echo "<p class='mensaje'>".$_SESSION["accion"]."</p>";
            unset($_SESSION["accion"]);
        }
        
    ?>
</body>
</html>