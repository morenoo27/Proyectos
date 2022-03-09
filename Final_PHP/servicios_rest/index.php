<?php
session_name("practFinal_login_21_22");
session_start();

require "funciones_servicios.php";
require __DIR__ . '/Slim/autoload.php';

$app = new \Slim\App;

$app->get('/logueado', function () {
    echo json_encode(seguridad(), JSON_FORCE_OBJECT);
});


/* SERVICIOS PARA EL LOGEO Y FIN DE LOGEO */

$app->get('/salir', function () {
    session_destroy();
    echo json_encode(array("nada" => "nada"), JSON_FORCE_OBJECT);
});

$app->post('/login', function ($request) {
    $datos[] = $request->getParam('usuario');
    $datos[] = $request->getParam('clave');

    echo json_encode(login_usuario($datos), JSON_FORCE_OBJECT);
});


/* SERVICIOS PARA LA APLICACION */

//PARA LOS USUARIOS
$app->get("/usuarios", function () {

    echo json_encode(obtener_usuarios(), JSON_FORCE_OBJECT);
});

//HORARIO DE USUARIO
$app->get("/horario/{id_usuario}", function ($request) {

    echo json_encode(obtener_horario($request->getAttribute("id_usuario")), JSON_FORCE_OBJECT);
});

//GRUPOS DE ESE DIA Y HORA
$app->get("/grupos/{dia}/{hora}/{id_usuario}", function ($request) {

    echo json_encode(obtener_grupos([$request->getAttribute("dia"), $request->getAttribute("hora"), $request->getAttribute("id_usuario")]), JSON_FORCE_OBJECT);
});

//TIENE GRUPO A ESA HORA Y DIA
$app->get("/tieneGrupo/{dia}/{hora}/{id_usuario}", function ($request) {

    echo json_encode(tiene_grupo([$request->getAttribute("dia"), $request->getAttribute("hora"), $request->getAttribute("id_usuario")]), JSON_FORCE_OBJECT);
});

//GRUPOS SIN PROF ASEIGNADO A ESE DIA Y HORA
$app->get("/gruposLibres/{dia}/{hora}/{id_usuario}", function ($request) {

    echo json_encode(grupos_libres([$request->getAttribute("dia"), $request->getAttribute("hora"), $request->getAttribute("id_usuario")]), JSON_FORCE_OBJECT);
});

//ELIMINAR ESE GRUPO EN ESA HORA
$app->delete("/borrarGrupo/{dia}/{hora}/{id_usuario}/{id_grupo}", function ($request) {

    echo json_encode(borrar_grupo([$request->getAttribute("dia"), $request->getAttribute("hora"), $request->getAttribute("id_usuario"), $request->getAttribute("id_grupo")]), JSON_FORCE_OBJECT);
});

//AÑADIR GRUPO
$app->post("/insertarGrupo/{dia}/{hora}/{id_usuario}/{id_grupo}/{id_aula}", function ($request) {

    echo json_encode(insertar_grupo([$request->getAttribute("dia"), $request->getAttribute("hora"), $request->getAttribute("id_usuario"), $request->getAttribute("id_grupo"), $request->getAttribute("id_aula")]), JSON_FORCE_OBJECT);
});

//OBTENER LAS AULAS SIN GRUPOS ASIGNADOS
$app->get("/aulasLibres/{dia}/{hora}", function ($request) {

    echo json_encode(aulas_libres([$request->getAttribute("dia"), $request->getAttribute("hora")]), JSON_FORCE_OBJECT);
});

//OBTENER LAS AULAS OCUPADAS
$app->get("/aulasOcupadas/{dia}/{hora}", function ($request) {

    echo json_encode(aulas_ocupadas([$request->getAttribute("dia"), $request->getAttribute("hora")]), JSON_FORCE_OBJECT);
});

//SERVICIO CONTROL AÑADIR AULA
$app->get("/comprobar_al_aniadir/{dia}/{hora}/{aula}", function ($request) {
    echo json_encode(comprobar_al_aniadir([$request->getAttribute("dia"), $request->getAttribute("hora"), $request->getAttribute("aula")]), JSON_FORCE_OBJECT);
});

//CAMBIO DE AULA DE UN GRUPO
$app->put("/actualizarAula/{aula}/{dia}/{hora}/{id_usuario}", function ($request) {

    echo json_encode(actualizar_aula([$request->getAttribute("aula"), $request->getAttribute("dia"), $request->getAttribute("hora"), $request->getAttribute("id_usuario")]), JSON_FORCE_OBJECT);
});

// Una vez creado servicios los pongo a disposición
$app->run();
