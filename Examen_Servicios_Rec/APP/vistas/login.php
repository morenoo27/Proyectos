<form action="" method="post">
    <p>
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" id="usuario" value="<?php if (isset($_POST['usuario'])) echo $_POST['usuario'] ?>">
        <?php
        if (isset($_POST['login']) && $error_user) {

            if ($_POST['usuario'] == '') {
                echo "<span>* CAMPO OBLIGATORIO *</span>";
            } else {
                echo "<span>* Usuario y/o contraseña incorrectos *</span>";
            }
        }
        ?>
    </p>
    <p>
        <label for="clave">Contraseña:</label>
        <input type="password" name="clave" id="clave">
        <?php
        if (isset($_POST['login']) && $err_pass) {
            echo "<span>* CAMPO OBLIGATORIO *</span>";
        }
        ?>
    </p>
    <button type="submit" name="login">Log In</button>
</form>