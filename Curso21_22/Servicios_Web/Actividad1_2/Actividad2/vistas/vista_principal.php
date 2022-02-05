<?php
$url = DIR_SERV . "/productos";
$respuesta = consumir_servicios_REST($url, "GET");
$obj = json_decode($respuesta);
if (!$obj) {
    die("<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta."/body></html>");
}
if (isset($obj->error)) {
    die("<p>" . $obj->error . "</p></body></html>");
}
echo "<h2>Listado de Productos</h2>
    <table>
                <tr>
                    <th>Código</th>
                    <th>Nombre Corto</th>
                    <th>PVP</th>
                    <th>Acción
                    <form class='linea' action='index.php' method='post'><button name='btnNuevo'>+</button></form></th>
                </tr>";
foreach ($obj->productos as $fila) {
    echo "<tr>
            <td><form class='linea' action='index.php' method='post'><button class='enlace' name='btnListar' value='".$fila->cod."'>" . $fila->cod . "</button></form></td>
            <td>" . $fila->nombre_corto . "</td>
            <td>" . $fila->PVP . "€</td>
            <td>
                <form class='linea' action='index.php' method='post'>
                    <button class='enlace' name='btnBorrar' value='".$fila->cod."'>Borrar</button>
                    -
                    <button class='enlace' name='btnEditar' value='".$fila->cod."'>Editar</button>
                </form>
            </td>
        </tr>";
}
echo "</table>";
?>