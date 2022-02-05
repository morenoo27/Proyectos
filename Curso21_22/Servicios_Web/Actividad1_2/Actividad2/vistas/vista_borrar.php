<?php
echo "<h2>¿Seguro que desea borrar el producto con ".$_POST["btnBorrar"]."</h2>";
echo "<form action='index.php' method='post'>
        <button name='btnContBorrar' value='".$_POST["btnBorrar"]."'>Confirmar</button>
        -
        <button >Volver</button>
    </form>
";
