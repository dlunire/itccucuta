<?php

use DLRoute\Requests\DLRoute;
use DLUnire\Auth\Auth;
use DLUnire\Controllers\FileController;
use DLUnire\Controllers\Install\InstallController;
use DLUnire\Controllers\TestController;
use DLUnire\Services\Utilities\Install;

DLRoute::get('/', [TestController::class, 'index']);

$auth = Auth::get_instance();

DLRoute::get('/install', [Install::class, 'index']);

# Ruta temporal para probar la subida de archivos
DLRoute::post('/upload/csv', [InstallController::class, 'upload']);


# URL del archivo enviado al servidor
DLRoute::get('/file/public/{uuid}', [FileController::class, 'index']);

DLRoute::get('/file/private/{uuid}', [FileController::class, 'private_file']);
