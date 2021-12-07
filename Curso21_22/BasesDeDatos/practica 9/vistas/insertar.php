<form action="index.php" method="post" enctype="multipart/form-data">

    <p>
        <label for="tituloPeli">Titulo de la película</label> <br>
        <input type="text" name="tituloPeli" id="tituloPeli" value="<?php if (isset($_POST["tituloPeli"])) echo $_POST["tituloPeli"] ?>">
        <?php /*ERRORES*/
        if (isset($_POST["insertarPelicula"]) && $errorTitulo) {
            echo "<span class='error'> * CAMPO OBLIGATORIO *</span>";
        }
        ?>
    </p>

    <p>
        <label for="directorPeli">Director de la película</label> <br>
        <input type="text" name="directorPeli" id="directorPeli" value="<?php if (isset($_POST["directorPeli"])) echo $_POST["directorPeli"] ?>">
        <?php /*ERRORES*/
        if (isset($_POST["insertarPelicula"]) && $errorDirector) {
            echo "<span class='error'> * CAMPO OBLIGATORIO *</span>";
        }
        ?>
    </p>

    <p>
        <label for="tematicaPeli">Temática de la película</label> <br>
        <input type="text" name="tematicaPeli" id="tematicaPeli" value="<?php if (isset($_POST["tematicaPeli"])) echo $_POST["tematicaPeli"] ?>">
        <?php /*ERRORES*/
        if (isset($_POST["insertarPelicula"]) && $errorTemática) {
            echo "<span class='error'> * CAMPO OBLIGATORIO *</span>";
        }
        ?>
    </p>

    <p>
        <label for="sinopsisPeli">Sinopsis de la película</label> <br>
        <textarea name="sinopsisPeli" id="sinopsisPeli" cols="30" rows="10">
            <?php
            if (isset($_POST["sinopsisPeli"])) {
                echo $_POST["sinopsisPeli"];
            }
            ?>
        </textarea>
        <?php /*ERRORES*/
        if (isset($_POST["insertarPelicula"]) && $errorSinopsis) {
            echo "<span class='error'> * CAMPO OBLIGATORIO *</span>";
        }
        ?>
    </p>

    <p>
        <label for="fotoPeli">Carátula de la película</label> <br>
        <input type="file" name="fotoPeli" id="fotoPeli" accept="img/*">
    </p>

    <p>
        <button type="submit" name="insertarPelicula">Insertar película</button>
        <button type="submit">Volver</button>
    </p>
</form>
