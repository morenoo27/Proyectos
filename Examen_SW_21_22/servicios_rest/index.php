<?php

require "src/funciones_servicios.php";
require __DIR__ . '/Slim/autoload.php';

$app = new \Slim\App;

$app->get('/conexion_PDO', function ($request) {

    echo json_encode(conexion_pdo(), JSON_FORCE_OBJECT);
});;

$app->get('/conexion_MYSQLI', function ($request) {

    echo json_encode(conexion_mysqli(), JSON_FORCE_OBJECT);
});


$app->post("/login", function ($request) {
    echo json_encode(login($request->getParam('usuario'), $request->getParam('clave')), JSON_FORCE_OBJECT);
});


$app->get("/horario/{id_usuario}", function ($request) {
    echo json_encode(horarioUser($request->getAttribute('id_usuario')), JSON_FORCE_OBJECT);
});


$app->get("/usuarios", function ($request) {
    echo json_encode(getUsers(), JSON_FORCE_OBJECT);
});


$app->get("/tieneGrupo/{dia}/{hora}/{id_usuario}", function ($request) {
    echo json_encode(tieneGrupo($request->getAttribute('dia'), $request->getAttribute('hora'), $request->getAttribute('id_usuario')), JSON_FORCE_OBJECT);
});


$app->get("/grupos/{dia}/{hora}/{id_usuario}", function ($request) {
    echo json_encode(grupos($request->getAttribute('dia'), $request->getAttribute('hora'), $request->getAttribute('id_usuario')), JSON_FORCE_OBJECT);
});


$app->get("/gruposLibres/{dia}/{hora}/{id_usuario}", function ($request) {
    echo json_encode(gruposLibres($request->getAttribute('dia'), $request->getAttribute('hora'), $request->getAttribute('id_usuario')), JSON_FORCE_OBJECT);
});

// Una vez creado servicios los pongo a disposición
$app->run();
