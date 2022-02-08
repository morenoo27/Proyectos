<?php

require "src/funciones_servicios.php";
require __DIR__ . '/Slim/autoload.php';

$app = new \Slim\App;

$app->post("/login", function ($request) {
    echo json_encode(login($request->getParam('usuario'), $request->getParam('clave')), JSON_FORCE_OBJECT);
});


// Una vez creado servicios los pongo a disposición
$app->run();
