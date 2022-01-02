<form action="index.php" method="post">
    <p>
        <label for="user">Usuario: </label>
        <input type="text" name="usuario" id="user" value="<?php if (isset($_POST["usuario"])) echo $_POST["usuario"] ?>">
        <?php
        if (isset($_POST["login"]) && $errorUsuario) {
            echo "<span class='error'>*CAMPO OBLIGATORIO*</span>";
        }
        ?>
    </p>
    <p>
        <label for="pass">Contraseña: </label>
        <input type="password" name="pass" id="pass">
        <?php
        if (isset($_POST["login"]) && $errorContraseña) {
            echo "<span class='error'>*CAMPO OBLIGATORIO*</span>";
        }
        ?>
    </p>
    <p>
        <?php
        //PULSADO ENTRAR + EXISTE ERROR
        if (isset($_POST["login"]) && isset($errorInicio)) {
            echo "<span class='error'>*Usuario y/o contraseña incorrectos*</span>";
        }

        if (isset($_SESSION["restringido"])) {
            echo $_SESSION["restringido"];

            session_destroy();
        }

        echo "<br>";
        ?>
        <button type="submit" name="login">Entrar</button>
    </p>
</form>