<?php

require "funciones_servicios.php";
require __DIR__ . '/Slim/autoload.php';

$app= new \Slim\App;

$app->get('/productos', function(){
    echo json_encode(obtenerProductos(), JSON_FORCE_OBJECT);
});

$app->get('/producto/{cod}', function($request){
    echo json_encode(obtenerProducto($request->getAttribute('cod')), JSON_FORCE_OBJECT);
});

$app->post('/insertar', function($request){
    $datos["cod"] = $request->getParam('cod');
    $datos["nombre"] = $request->getParam('nombre');
    $datos["nombre_corto"] = $request->getParam('nombre_corto');
    $datos["descripcion"] = $request->getParam('descripcion');
    $datos["PVP"] = $request->getParam('PVP');
    $datos["familia"] = $request->getParam('familia');
    echo json_encode(insertarProducto($datos), JSON_FORCE_OBJECT);
});

$app->put('/actualizar/{cod}', function($request){
    $datos["cod"] = $request->getAttribute('cod');
    $datos["nombre"] = $request->getParam('nombre');
    $datos["nombre_corto"] = $request->getParam('nombre_corto');
    $datos["descripcion"] = $request->getParam('descripcion');
    $datos["PVP"] = $request->getParam('PVP');
    $datos["familia"] = $request->getParam('familia');
    echo json_encode(actualizarProducto($datos), JSON_FORCE_OBJECT);
});

$app->delete('/borrar/{cod}', function($request){
    echo json_encode(borrarProducto($request->getAttribute('cod')), JSON_FORCE_OBJECT);
});

$app->get('/familias', function(){
    echo json_encode(obtenerFamilias(), JSON_FORCE_OBJECT);
});

$app->get('/repetido/{tabla}/{columna}/{valor}', function($request){
    echo json_encode(repetido($request->getAttribute('tabla'), $request->getAttribute('columna'), $request->getAttribute('valor')), JSON_FORCE_OBJECT);
});

$app->get('/repetido/{tabla}/{columna}/{valor}/{columna_id}/{valor_id}', function($request){
    echo json_encode(repetido($request->getAttribute('tabla'), $request->getAttribute('columna'), $request->getAttribute('valor'), $request->getAttribute('columna_id'), $request->getAttribute('valor_id')), JSON_FORCE_OBJECT);
});

// Una vez creado servicios los pongo a disposición
$app->run();
?>