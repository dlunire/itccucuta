<?php

declare(strict_types=1);

use DLRoute\Requests\DLRoute;
use DLUnire\Controllers\Install\InstallController;
use DLUnire\Services\Install\Install;


/** @var Install $install */
$install = new Install();
$install->run();

DLRoute::get('/install/credentials', [InstallController::class, 'credentials']);

## INSTALACIÓN DE LAS CREDENCIALES
DLRoute::post('/install/credentials', [InstallController::class, 'store']);

## VERIFICAR LAS CREDENCIALES
DLRoute::get('/credentials/check', [InstallController::class, 'check_view']);
DLRoute::post('/credentials/check', [InstallController::class, 'check']);