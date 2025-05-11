<?php

use DLRoute\Requests\DLRoute;
use DLUnire\Auth\Auth;
use DLUnire\Controllers\TestController;
use DLUnire\Models\Users;
use DLUnire\Services\Utilities\Install;

DLRoute::get('/', [TestController::class, 'index']);

$auth = Auth::get_instance();

DLRoute::get('/install', [Install::class, 'index']);
