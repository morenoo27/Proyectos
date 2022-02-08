<?php

require "funciones_servicios.php";
require __DIR__ . '/Slim/autoload.php';

$app = new \Slim\App;

$app->post("/login", function ($request) {

    echo json_encode(login($request->getParam('usuario'), $request->getParam('clave')), JSON_FORCE_OBJECT);
});

$app->get("/usuarioGuardia/{dia}/{hora}", function ($request) {
    echo json_encode(horario($request->getAttribute('dia'), $request->getAttribute('hora')), JSON_FORCE_OBJECT);
});

$app->get("/usuarioGuardia/{dia}/{hora}/{id_usuario}", function ($request) {
    echo json_encode(deGuardia($request->getAttribute('dia'), $request->getAttribute('hora'), $request->getAttribute('id_usuario')), JSON_FORCE_OBJECT);
});

// Una vez creado servicios los pongo a disposición
$app->run();
