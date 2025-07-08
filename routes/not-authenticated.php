<?php

declare(strict_types=1);

use DLRoute\Requests\DLRoute;
use DLUnire\Auth\Auth;
use DLUnire\Controllers\Auth\AuthController;

/** @var Auth $auth */
$auth = Auth::get_instance();

## Permite iniciar la sesión del usuario:
$auth->not_authenticated(function () {
    // print_r("No autenticado");
    // exit;

    ## Formulario de inicio de sesión
    DLRoute::get('/login', [AuthController::class, 'index']);

    ## Acción de inicio de sesión:
    DLRoute::post('/login', [AuthController::class, 'login']);
});

## RUTAS QUE DEBEN IMPLEMENTAR RECIRECT
$auth->not_authenticated(function () {
    DLRoute::get('/dashboard', function () {
        redirect('/login');
    });
});