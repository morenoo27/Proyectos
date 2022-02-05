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
if(!(isset($_POST["btnContEditar"]))){
    $url = DIR_SERV."/producto/".urlencode($_POST["btnEditar"]);
    $respuesta = consumir_servicios_REST($url, "GET");
    $obj2 = json_decode($respuesta);
    if (!$obj2) {
        die("<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta);
    }
    if (isset($obj2->error)) {
        die("<p>" . $obj2->error . "</p>");
    }
    $datos["cod"] = $obj2->producto->cod;
    $datos["nombre"] = $obj2->producto->nombre;
    $datos["nombre_corto"] = $obj2->producto->nombre_corto;
    $datos["descripcion"] = $obj2->producto->descripcion;
    $datos["PVP"] = $obj2->producto->PVP;
    $datos["familia"] = $obj2->producto->familia;
}

?>

<h2>Editando Producto <?php echo $datos["cod"]; ?></h2>
<table class='formulario'>
    <form action='index.php' method='post'>
    <tr>
    <td class='formulario'>
        <label for='cod'><strong>Código:</strong></label>
    </td>
    <td class='formulario'>
        <input type='text' name='cod' maxlength="12" id='cod' value='<?php echo $datos["cod"] ?>'>
        <?php
            if(isset($_POST["btnContEditar"]) && $error_cod){
                if($datos["cod"] == ""){
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
        <input type='text' name='nombre' id='nombre' value='<?php if(isset($datos["nombre"])) echo $datos["nombre"] ?>'>
        <?php
            if(isset($_POST["btnContEditar"]) && $error_nombre){
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
        <input type='text' name='corto' id='corto' value='<?php if(isset($datos["nombre_corto"])) echo $datos["nombre_corto"] ?>'>
        <?php
            if(isset($_POST["btnContEditar"]) && $error_nombre_corto){
                if($datos["nombre_corto"] == ""){
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
        <textarea name='descrip' id='descrip' cols='30' rows='10'><?php if(isset($datos["descripcion"])) echo $datos["descripcion"] ?></textarea>
        <?php
            if(isset($_POST["btnContEditar"]) && $error_descripcion){
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
        <input type='text' name='pvp' id='pvp' value='<?php if(isset($datos["PVP"])) echo $datos["PVP"] ?>'>
        <?php
            if(isset($_POST["btnContEditar"]) && $error_PVP){
                if($datos["pvp"] == ""){
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
            if(isset($datos["familia"]) && $datos["familia"] == $fila->cod){
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
    <?php
        if(isset($_POST["btnEditar"])){
            ?>
            <button name='btnContEditar' value='<?php echo $_POST["btnEditar"]; ?>'>Continuar</button>
            <?php
        }else{
            ?>
            <button name='btnContEditar' value='<?php echo $_POST["btnContEditar"]; ?>'>Continuar</button>
            <?php
        }
    ?>
    -
    <button >Volver</button>
</form>