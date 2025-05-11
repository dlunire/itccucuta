<?php

use DLRoute\Requests\DLRoute;
use DLUnire\Auth\Auth;
use DLUnire\Controllers\TestController;
use DLUnire\Models\Users;

DLRoute::get('/', [TestController::class, 'index']);

$auth = Auth::get_instance();

DLRoute::get('/test', function () {
    return Users::get();
});
