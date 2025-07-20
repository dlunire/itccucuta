<?php

declare(strict_types=1);

use DLRoute\Requests\DLRoute;
use DLUnire\Auth\Auth;
use DLUnire\Controllers\Admin\Dashboard\DashboardController;
use DLUnire\Controllers\Admin\Files\FileController;
use DLUnire\Controllers\Auth\AuthController;
use DLUnire\Models\Users;

/** @var Auth $auth */
$auth = Auth::get_instance();

DLRoute::get('/', function () {
    redirect("/login");
});

## AUTENTICACIÓN CON RUTAS INEXISTENTES O NO REGISTRADAS PARA FACILITAR REDIRECCIÓN
$auth->authenticated(function () {

    # Panel principal
    DLRoute::get('/dashboard', [DashboardController::class, 'index']);

    ## Certificados
    DLRoute::get('/dashboard/certificate', [DashboardController::class, 'certificate']);

    ## Historial
    DLRoute::get('/dashboard/history', [DashboardController::class, 'history']);

    ## Zona de de configuración:
    DLRoute::get('/dashboard/settings', [DashboardController::class, 'settings']);

    ## Zona de de configuración:
    DLRoute::get('/dashboard/profile', [DashboardController::class, 'profile']);
});

## RUTAS QUE DEBEN SER REDIRIGIDA O DEBEN APLICAR UN REDIRECT
$auth->authenticated(function () {
    DLRoute::get('/login', function () {
        redirect("/dashboard");
    });
});

## AUTENTICACIÓN CON MENSAJE EXPLÍCITO
$auth->logged(function () {
    ## CERRAR SESIÓN
    DLRoute::delete('/logout', [AuthController::class, 'logout']);

    DLRoute::get('/test', function () {
        return Users::paginate(1, 10);
    });
});
## Certificados al servidor:
DLRoute::post('/dashboard/upload', [FileController::class, 'upload']);