<header>
    <h1>Simulacro examen</h1>

    <div id="mensaje_bienvenida_con_salir">
        <div id="mensaje">
            <span>Bienvenido, <i><?php echo $_SESSION["usuario"] ?></i></span>
        </div>

        <div id="espacio"> - </div>

        <div id="boton">
            <form action="cliente.php" method="post">
                <button type="submit" id="boton_salir" name="salir">Cerrar Sesion</button>
            </form>
        </div>
    </div>


</header>

<main>

    <p>Accediendo a vista de usuario normal</p>

    <form action="cliente.php" method="post">
        <button type="submit" name="accion">Accion</button>
    </form>
</main>