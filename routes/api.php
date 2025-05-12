<?php

use DLRoute\Requests\DLRoute;
use DLUnire\Auth\Auth;
use DLUnire\Controllers\Auth\AuthController;

/** @var Auth $auth */
$auth = Auth::get_instance();


# Para las rutas no autenticadas:
$auth->not_authenticated(function () {

    # Iniciar sesión:
    DLRoute::post("/login", [AuthController::class, 'login']);
});

$auth->authenticated(function () {
    # Permite comprobar si el usuario ha sido autenticado para una petición por 
    # medio de una API.
    DLRoute::get('/logged', function () {
    });
});


DLRoute::get('/css', function () {
    return [
        "content" => "Esta es una prueba"
    ];
});
