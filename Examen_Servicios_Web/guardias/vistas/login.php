<form action="" method="post">
    <p>
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" id="usuario">

        <?php
        if (isset($_POST['login']) && $error_user) {

            if ($_POST['usuario'] == '') {
                echo "<span class='error'>*CAMPO VACIO*</span>";
            } else {
                echo "<span class='error'>*Usuario y/o contraseña incorrectos*</span>";
            }
        }
        ?>
    </p>
    <p>
        <label for="clave">Contraseña:</label>
        <input type="password" name="clave" id="clave">

        <?php
        if (isset($_POST['login']) && $error_pass) {
            echo "<span class='error'>*CAMPO VACIO*</span>";
        }
        ?>
    </p>
    <button type="submit" name="login">Log In</button>
</form>