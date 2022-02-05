<?php
//PARA EL SELECT DE LOS FORMULARIOS
$url = DIR_SERV . "/familias";
$respuesta = consumir_servicios_REST($url, "GET");
$obj = json_decode($respuesta);
if (!$obj) {
    die("<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta);
}
if (isset($obj->error)) {
    die("<p>" . $obj->error . "</p>");
}
?>

<h2>Nuevo Producto</h2>
<table class='formulario'>
    <form action='index.php' method='post'>
    <tr>
    <td class='formulario'>
        <label for='cod'><strong>Código:</strong></label>
    </td>
    <td class='formulario'>
        <input type='text' name='cod' maxlength="12" id='cod' value='<?php if(isset($_POST["cod"])) echo $_POST["cod"] ?>'>
        <?php
            if(isset($_POST["btnContNuevo"]) && $error_cod){
                if($_POST["cod"] == ""){
                    echo "<span class='error'> ** Campo Vacío ** </span>";
                }else{
                    echo "<span class='error'> ** Código Repetido ** </span>";
                }
            }
        ?>
    </td>
    </tr>
    <tr>
    <td class='formulario'>
        <label for='nombre'><strong>Nombre:</strong></label>
    </td>
    <td class='formulario'>
        <input type='text' name='nombre' id='nombre' value='<?php if(isset($_POST["nombre"])) echo $_POST["nombre"] ?>'>
        <?php
            if(isset($_POST["btnContNuevo"]) && $error_nombre){
                echo "<span class='error'> ** Campo Vacío ** </span>";
            }
        ?>
    </td>
    </tr>
    <tr>
    <td class='formulario'>
        <label for='corto'><strong>Nombre Corto:</strong></label>
    </td>
    <td class='formulario'>
        <input type='text' name='corto' id='corto' value='<?php if(isset($_POST["corto"])) echo $_POST["corto"] ?>'>
        <?php
            if(isset($_POST["btnContNuevo"]) && $error_nombre_corto){
                if($_POST["corto"] == ""){
                    echo "<span class='error'> ** Campo Vacío ** </span>";
                }else{
                    echo "<span class='error'> ** Nombre Corto Repetido ** </span>";
                }
            }
        ?>
    </td>
    </tr>
    <tr>
    <td class='formulario'>
        <label for='descrip'><strong>Descripción:</strong></label>
    </td>
    <td class='formulario'>
        <textarea name='descrip' id='descrip' cols='30' rows='10'><?php if(isset($_POST["descrip"])) echo $_POST["descrip"] ?></textarea>
        <?php
            if(isset($_POST["btnContNuevo"]) && $error_descripcion){
                echo "<span class='error'> ** Campo Vacío ** </span>";
            }
        ?>
    </td>
    </tr>
    <tr>
    <td class='formulario'>
        <label for='pvp'><strong>PVP:</strong></label>
    </td>
    <td class='formulario'>
        <input type='text' name='pvp' id='pvp' value='<?php if(isset($_POST["pvp"])) echo $_POST["pvp"] ?>'>
        <?php
            if(isset($_POST["btnContNuevo"]) && $error_PVP){
                if($_POST["pvp"] == ""){
                    echo "<span class='error'> ** Campo Vacío ** </span>";
                }else{
                    echo "<span class='error'> ** Cantidad incorrecta de PVP ** </span>";
                }
            }
        ?>
    </td>
    </tr> 
    <tr>
    <td class='formulario'>
        <label for='familia'><strong>Familia:</strong></label>
    </td>
    <td class='formulario'>
<?php
        echo "<select name='familia' id='familia'>";
        foreach ($obj->familias as $fila) {
            if(isset($_POST["familia"]) && $_POST["familia"] == $fila->cod){
                echo "<option value='".$fila->cod."' selected>".$fila->nombre."</option>";
            }else{
                echo "<option value='".$fila->cod."'>".$fila->nombre."</option>";
            }
        }
?>
        </select>
    </td>
    </tr>
</table>

<br/><br/>
    <button name='btnContNuevo' value='<?php echo $_POST["btnNuevo"]; ?>'>Añadir</button>
    -
    <button >Volver</button>
</form>