<?php

use DLRoute\Requests\DLRoute;
use DLUnire\Auth\Auth;
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

$auth->authenticated(function () {
});

# URL del archivo enviado al servidor. Una ruta que requiere autenticación
DLRoute::get('/file/private/{uuid}', [FileController::class, 'private_file'])->filter_by_type([
    "uuid" => "uuid"
]);


## Permite iniciar la sesión del usuario:
$auth->not_authenticated(function () {
    DLRoute::get('/login', [AuthController::class, 'index']);
});