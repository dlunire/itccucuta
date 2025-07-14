<?php

declare(strict_types=1);

use DLRoute\Requests\DLRoute;
use DLUnire\Auth\Auth;
use DLUnire\Controllers\Admin\Dashbord\DashboardController;
use DLUnire\Controllers\Auth\AuthController;
use DLUnire\Models\Users;

/** @var Auth $auth */
$auth = Auth::get_instance();

DLRoute::get('/', function () {
    redirect("/login");
});

$auth->authenticated(function () {

    DLRoute::get("/session-test", function () {
        return [
            "status" => true,
            "success" => "Si observas esto, entonces, el inicio de sesión ha funcionado"
        ];
    });

    DLRoute::get('/dashboard', [DashboardController::class, 'index']);
});

## RUTAS QUE DEBEN SER REDIRIGIDA O DEBEN APLICAR UN REDIRECT
$auth->authenticated(function () {
    DLRoute::get('/login', function () {
        redirect("/dashboard");
    });
});

$auth->logged(function () {
    ## CERRAR SESIÓN
    DLRoute::delete('/logout', [AuthController::class, 'logout']);

    DLRoute::get('/test', function () {
        return Users::paginate(1, 10);
    });
});
