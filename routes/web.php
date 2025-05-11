<?php

use DLRoute\Requests\DLRoute;
use DLUnire\Auth\Auth;
use DLUnire\Controllers\TestController;

DLRoute::get('/', [TestController::class, 'index']);

$auth = Auth::get_instance();
