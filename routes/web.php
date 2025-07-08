<?php

use DLRoute\Requests\DLRoute;
use DLUnire\Auth\Auth;
use DLUnire\Controllers\Admin\Dashbord\DashboardController;
use DLUnire\Controllers\Auth\AuthController;
use DLUnire\Controllers\FileController;
use DLUnire\Controllers\Install\InstallController;
use DLUnire\Controllers\TestController;
use DLUnire\Services\Utilities\Install;

DLRoute::get('/', [TestController::class, 'index']);

/** @var Auth $auth */
$auth = Auth::get_instance();

DLRoute::get('/install', [Install::class, 'index']);

# Ruta temporal para probar la subida de archivos | Requiere autenticación
DLRoute::post('/upload/csv', [InstallController::class, 'upload']);


# URL del archivo enviado al servidor. Una ruta que no requiere autenticación
DLRoute::get('/file/public/{uuid}', [FileController::class, 'public_file'])->filter_by_type([
    "uuid" => "uuid"
]);

$auth->logged(function () {
    DLRoute::get("/session-test", function () {
        return [
            "status" => true,
            "success" => "Si observas esto, entonces, el inicio de sesión ha funcionado"
        ];
    });

    DLRoute::get('/dashboard', [DashboardController::class, 'index']);
});

# URL del archivo enviado al servidor. Una ruta que requiere autenticación
DLRoute::get('/file/private/{uuid}', [FileController::class, 'private_file'])->filter_by_type([
    "uuid" => "uuid"
]);

## Permite iniciar la sesión del usuario:
$auth->not_logged(function () {
    ## Formulario de inicio de sesión
    DLRoute::get('/login', [AuthController::class, 'index']);

    ## Acción de inicio de sesión:
    DLRoute::post('/login', [AuthController::class, 'login']);
});