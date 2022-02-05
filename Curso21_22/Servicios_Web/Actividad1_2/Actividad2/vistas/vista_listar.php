<?php
$url = DIR_SERV . "/producto/".urlencode($_POST["btnListar"]);
$respuesta = consumir_servicios_REST($url, "GET");
$obj = json_decode($respuesta);
if (!$obj) {
    die("<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta);
}
if (isset($obj->error)) {
    die("<p>" . $obj->error . "</p>");
}
echo "<h2>Detalles del Producto ".$_POST["btnListar"]."</h2>";
if (isset($obj->mensaje)) {
    echo "<p>El producto seleccionado ya no se encuentra en la BBDD</p>";
} else {
    echo "<p><strong>Nombre: </strong>" . $obj->producto->nombre . "</p>";
    echo "<p><strong>Nombre Corto: </strong>" . $obj->producto->nombre_corto . "</p>";
    echo "<p><strong>Descripción: </strong>" . $obj->producto->descripcion . "</p>";
    echo "<p><strong>PVP: </strong>" . $obj->producto->PVP . "€</p>";
    echo "<p><strong>Familia: </strong>" . $obj->producto->familia . "</p>";
}
?>